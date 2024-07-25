pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";

async function downloadFile(type, title) { // function pang handle ng document na paglalagyan ng contents
    try {
       const { jsPDF } = window.jspdf;
       let content = await pdfContentHandler(type, title);
       var doc = new jsPDF();
       const margins = { 
             top: 10,
             bottom: 10,
             left: 10,
             width: 180
       };
       doc.setFontSize(10); 

       // codes naman to para yung title sa document is nasa gitna
       doc.setFontSize(16); 
       doc.text(title, doc.internal.pageSize.width / 2, margins.top, { align: 'center' });
       doc.setFontSize(10);
       // di ko alam kung bakit need mag set ng font size ng dalawang beses pero as long as gumagana

       addText(doc, content, margins); 
       doc.save(`${title}.pdf`);
    } catch (error) {
       console.error('Error:', error.message);
    }
}

function addText(doc, text, margins) {
    let lineHeight = doc.getLineHeight(); // kunin yung height nung kabuuang text/content
    let lines = doc.splitTextToSize(text, margins.width); // hatiin yung text pag di na kasya sa isang page
    let cursorY = margins.top + 20; // ewan ko dito, basta kukuhain na yung position ng cursor, mahalaga daw yan

    lines.forEach(line => { 
       // if mataas na daw ang height ng text/content to the point na it exceed page size and margin...
       if (cursorY + lineHeight > doc.internal.pageSize.height - margins.bottom) {
          // .. mag-aadd pa ng isa pang page
             doc.addPage();
             cursorY = margins.top; // cursor position
       }
       doc.text(margins.left, cursorY, line);
       cursorY += lineHeight; // ililipat yung cursor position on next line
    });
}

pdfContentHandler = async (type, title) => {
    switch (type) {
       case "mcq":
             return await mcqFormat(title);
       case "tof":
             return await tofFormat(title);
       case "owa":
             return await owaFormat(title);
    }
}

mcqFormat = async (title) => {
    const file = '../quiz/mcq/mcq-qna.json';
    let indexCounter = 1;
    let output = ``;

    try {
        let response = await fetch(file);
        let data = await response.json();

        data.qna.forEach(element => {
                let q = element.question;
                let a = element.A;
                let b = element.B;
                let c = element.C;
                let d = element.D;
                let answer = element.answer;
                output += `${indexCounter}. ${q}\n`;
                output += `A. ${a}\n`;
                output += `B. ${b}\n`;
                output += `C. ${c}\n`;
                output += `D. ${d}\n`;
                output += `Answer: ${answer}\n\n`;

                if (indexCounter % 4 == 0) {
                    output += `\n`;
                }

                indexCounter++;
        });

    } catch (error) {
       console.error("error", error);
    }

    return output;
}

owaFormat = async (title) => {
    const file = '../quiz/owa/owa-qna.json';
    let indexCounter = 1;
    let output = ``;
    
    try {
        let response = await fetch(file);
        let data = await response.json();

        data.qna.forEach(element => {
                let q = element.question;
                let answer = element.answer;
                output += `${indexCounter}. ${q}\n`;
                output += `Answer: ${answer}\n\n`;
                indexCounter++;
        });

    } catch (error) {
       console.error("error", error);
    }

    return output;
}

tofFormat = async (title) => {
    const file = '../quiz/tof/tof-qna.json';
    let indexCounter = 1;
    let output = ``;
    
    try {
        let response = await fetch(file);
        let data = await response.json();

        data.qna.forEach(element => {
                let q = element.question;
                let answer = element.answer;
                output += `${indexCounter}. ${q}\n`;
                output += `Answer: ${answer}\n\n`;
                indexCounter++;
        });

    } catch (error) {
       console.error("error", error);
    }

    return output;
}