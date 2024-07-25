const quizBtn = document.getElementById("quiz");
const downloadBtn = document.getElementById("download");
quizBtn.disabled = true;
downloadBtn.disabled = true;

const API_URL = "https://api.openai.com/v1/chat/completions";
const API_KEY = "";
let controller = null;

main = async (uploadedfiles) => {
    let content = await fileProcessing(uploadedfiles);
    promptHandler(difficulty, type, noOfQuestions, content);
}

fileProcessing = async (uploadedfiles) => {
    let content = "";
    for (let i = 0; i < uploadedfiles.length; i++) {
        let text = await extractText(uploadedfiles[i], false);
        content += text;
    }
    return content;
}

async function extractText(url, pass) {
    try {
        console.log("URL:", url); // Debugging statement
        let pdf;
        if (pass) {
                pdf = await pdfjsLib.getDocument({ url: url }).promise; // Get the PDF document with password
        } else {
                pdf = await pdfjsLib.getDocument(url).promise; // Get the PDF document without password
        }
       
        console.log(pdf);

        let pages = pdf.numPages; // Get the total number of pages in the PDF
        let alltext = "";
        for (let i = 1; i <= pages; i++) {
                let page = await pdf.getPage(i); // Get the page object for each page
                let txt = await page.getTextContent(); // Get the text content of the page
                let text = txt.items.map((s) => s.str).join(""); // Concatenate the text items into a single string
                alltext += text + "\n"; // Add the extracted text to the variable
        }
        return alltext;

    } catch (err) {
        console.log("Error extracting text: ", err);
    }
}

promptHandler = (difficulty, type, noOfQuestions, content) => {

    console.log(content);

    let prompt = "";

    if(type == "mcq"){
        prompt += `Using the text given below, give me ${noOfQuestions} ${difficulty} multiple choice questions and answers strictly using a JSON format: {"qna": [{"question": "<insert question here>",  "A": "<insert choice A>", "B": "<insert choice B>", "C": "<insert choice C>", "D": "<insert choice D>", "answer": "<insert letter of answer"}, {"question": "<insert question here>",  "A": "<insert choice A>", "B": "<insert choice B>", "C": "<insert choice C>", "D": "<insert choice D>", "answer": "<insert letter of answer"}, repeat ]}`;
        prompt += content;
    } else if (type == "owa") {
        prompt += `Generate ${noOfQuestions} ${difficulty} questions based on the following text. Each question should have ONLY ONE answer, which must be ONE WORD ONLY and cannot contain 'and' or 'or'.  Format: {"qna": [{"question": "<insert question>", "answer": "<insert answer>"},     {"question": "<insert question>", "answer": "<insert answer>"}, ... ]}`;
        prompt += content;
    }
    sendPrompt(prompt);
}

sendPrompt = async (prompt) => {
    controller = new AbortController();
    const signal = controller.signal;

    try {
        // Fetch the response from the OpenAI API with the signal from AbortController
        const response = await fetch(API_URL, {
            method: "POST",
            headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${API_KEY}`,
            },
            body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{ role: "user", content: prompt }],
            max_tokens: 2000,
            }),
            signal, // Pass the signal to the fetch request
        });

        const data = await response.json();
        result = data.choices[0].message.content;
        console.log(data.choices[0].message.content);
        const regex = /\{[\s\S]*\}/;
        const match = result.match(regex);
        if (match) {
        result = match[0];
        console.log(result);
        }
       
        $(document).ready(function() {
                $.ajax({
                    url: 'dataToJson.php', // Path to your PHP file
                    type: 'POST', // Method used to send the data
                    data: { content: result, type: type }, // Data to be sent
                    success: function(response) {
                    console.log(response)
                    quizBtn.disabled = false;
                    downloadBtn.disabled = false; // Display the response from PHP
                    },
                    error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors
                    }
                });
        });
    
    } catch (error) {
        // Handle fetch request errors
        if (signal.aborted) {
            alert("Request aborted.");
        } else {
            console.error("Error:", error);
            alert("Error occurred while generating.");
        }
    } finally {
        // Enable the generate button and disable the stop button
        controller = null; // Reset the AbortController instance
    }

}