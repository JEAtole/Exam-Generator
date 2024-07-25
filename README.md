# Exam-Generator

The Automated Exam Generator is a tool designed to simplify the process of creating exams. By accepting PDF files as input, this application generates exams based on user preferences. The types of questions generated include multiple choice, one-word answer questions, and true/false questions. The system leverages OpenAI to generate the questions, ensuring high-quality and relevant exam content.

## Features
- PDF Input: Upload a PDF file to serve as the source material for the exam questions.
- Question Types: Generate multiple choice, one-word answer, and true/false questions.
- Customization: Set preferences for the difficulty and number of questions to be generated.
- OpenAI Integration: Utilizes OpenAI's advanced language model to create relevant and accurate exam questions.
- Exam Taking: Users can take the generated exams directly within the web app.

## Technologies Used
HTML, CSS, JavaScript, PHP, and Bootstrap

## Installation
To use this web app locally, follow these steps:

1. **Clone the repository:**
   ```
   git clone https://github.com/JEAtole/Exam-Generator.git
   ```
2. **Navigate to the project directory:**
   ```
   cd Exam-Generator
   ```
3. **Configuration:** Ensure you have an OpenAI API key and set it in `generating/generate.js line:07`. 
   
4. **Set up a local server:** You will need to install a local server environment such as XAMPP or Laragon.
   - **XAMPP:** [Download XAMPP](https://www.apachefriends.org/index.html) and install it.
   - **Laragon:** [Download Laragon](https://laragon.org/) and install it.

5. **Move the project to the server's root directory:**
   - For XAMPP, move the project folder to `C:\xampp\htdocs`.
   - For Laragon, move the project folder to `C:\laragon\www`.

6. **Start the local server:**
   - Open the XAMPP or Laragon control panel and start the Apache server.

7. **Access the web app:**
   - Open your web browser and go to `http://localhost/Exam-Generator`.

## Usage
1. Run the application by accessing it through the local server.
2. Upload a PDF file when prompted.
3. Select your preferences for the type, difficulty and number of questions.
4. Generate the exam and start taking it within the web app.
