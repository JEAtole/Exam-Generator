<!DOCTYPE html>
<html lang="en">
<html>
   <head>
      <!-- Set the character encoding to UTF-8 -->
      <meta charset="UTF-8">
      <!-- Specify the compatibility mode for Internet Explorer -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Set the viewport to control the layout on mobile devices -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Set the title of the web page -->
      <title>Exam Gen</title>
      <!-- Include the PDF.js library -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>

      <style>

         body {
            padding-bottom: 100px;
            padding-top: 100px;
         }

         section {
            height: fit-content;
            width: 100%;
            padding: 50px;
         }

         .box {
            min-height: 300px;
            background: #000000;
            border-radius: 25px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
         }

         .sm-box {
            height: fit-content;
            padding: 5px;
            background-color: #FFFFFF;
            color: #000000;
            border-radius: 5px;
         }
         
         button {
            border-radius: 10px;
            background: #000000;
            color: #FFFFFF;
            padding: 5px;
         }

         p{
            margin: 0;
         }

         .txt-black {
            color: #000000;
         }

      </style>

   </head>

   <body>
      
      <!-- Navbar -->

      <nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 50px;">
         <div class="container">

            <div class="navbar-header">
               <div class="navbar-brand">Prototype / Group Name</div>
            </div>

            <ul class="nav navbar-nav navbar-right">
               <li><a href="about.php">ABOUT</a></li>
            </ul>

         </div>
      </nav>
      
      <!-- Title Part And File Upload-->

      <div class="container-fluid">  

         <section class="d-flex align-items-center justify-content-center row">

            <div class="text-center">
               <h1>Automated Exam Generator</h1>
               <p>Select PDF files to upload (max. 1MB)</p>

               <br/>
               
               <div class="col-md-6 col-md-offset-3">
                  <input type="file" placeholder="Upload File" class="form-control">
               </div>

               <br/><br/><br/>

               <div class="col-md-2 col-md-offset-5">
                  <button type="button" class="btn-block">Upload</button>
               </div>
            </div>  
            <!-- JavaScript code -->
            <script>
            // Set the worker source for PDF.js library
            pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js";
         
          // Get references to various elements
          let pdfinput = document.querySelector(".selectpdf"); // Reference to the PDF file input field
          let pwd = document.querySelector(".pwd"); // Reference to the password input field
          let upload = document.querySelector(".upload"); // Reference to the upload button
          let afterupload = document.querySelector(".afterupload"); // Reference to the result section
          let select = document.querySelector("select"); // Reference to the page selection dropdow
          let download = document.querySelector(".download"); // Reference to the download link
          let pdftext = document.querySelector(".pdftext"); // Reference to the text area for displaying extracted text
         
          // Event listener for the upload button click
          upload.addEventListener('click', () => {
            let file = pdfinput.files[0]; // Get the selected PDF file
            if (file != undefined && file.type == "application/pdf") {
               let fr = new FileReader(); // Create a new FileReader object
               fr.readAsDataURL(file); // Read the file as data URL 
               fr.onload = () => {
                  let res = fr.result; // Get the result of file reading
                    extractText(res, true); // Extract text with password    
            }
        } else {
            alert("Select a valid PDF file");
        }
    });

    let alltext = []; // Array to store all extracted text
    
    // Asynchronous function to extract text from the PDF
    async function extractText(url, pass) {
        try {
            let pdf;
            if (pass) {
                pdf = await pdfjsLib.getDocument({ url: url, password: pwd.value }).promise; // Get the PDF document with password
            } else {
                pdf = await pdfjsLib.getDocument(url).promise; // Get the PDF document without password
            }
            let pages = pdf.numPages; // Get the total number of pages in the PDF
            for (let i = 1; i <= pages; i++) {
                let page = await pdf.getPage(i); // Get the page object for each page
                let txt = await page.getTextContent(); // Get the text content of the page
                let text = txt.items.map((s) => s.str).join(""); // Concatenate the text items into a single string
                alltext.push(text); // Add the extracted text to the array
            }
            alltext.map((e, i) => {
                select.innerHTML += `<option value="${i+1}">${i+1}</option>`; // Add options for each page in the page selection dropdown
            });
            afterProcess(); // Display the result section
        } catch (err) {
            alert(err.message);
        }
    }
    
     Function to handle the post-processing after text extraction
     function afterProcess() {
         pdftext.value = alltext[select.value - 1]; // Display the extracted text for the selected page
         download.href = "data:text/plain;charset=utf-8," + encodeURIComponent(alltext[select.value - 1]); // Set the download link URL for the extracted text
         afterupload.style.display = "flex"; // Display the result section
        document.querySelector(".another").style.display = "unset"; // Display the "Extract Another PDF" button
    }
    

         </section>
         
         <!-- Files Uploaded -->

         <section class="row">
            <div class="container-fluid box col-md-6 col-md-offset-3">
               <h3 class="text-center" style="color: #FFFFFF;">Files Uploaded</h3>

               <div id="files-container">

                  <!-- Insert file uploaded here via javascript. Sample below -->

                  <div>
                     <div class="alert sm-box text-center"><a href="#" class="close txt-black" data-dismiss="alert">&times;</a>File.pdf</div>
                  </div>

               </div>

            </div>
         </section>

         <!-- Customization -->

         <section class="row">
            <div class="text-center">
               <h2>Exam Customization</h2>
               <p>Edit difficulty and question type to be generated.</p>
            </div>
            
            <br/>

            <form class="form-horizontal">

               <div class="form-group">
                  <label class="control-label col-md-2 col-md-offset-1">Title</label>
                  <div class="col-md-7">
                     <input type="text" class="form-control">
                  </div>
               </div>

               <h4 class="text-center">Difficulty</h4>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Easy</label>
                  <div class="col-md-7">
                     <input type="text" class="form-control" placeholder="%">
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Medium</label>
                  <div class="col-md-7">
                     <input type="text" class="form-control" placeholder="%">
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Hard</label>
                  <div class="col-md-7">
                     <input type="text" class="form-control" placeholder="%">
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Question Type</label>
                  <div class="col-md-7">
                     <div class="radio">
                        <label><input type="radio" name="gender">Multiple Choice</label>
                        <label><input type="radio" name="gender">Descriptive</label>
                        <label><input type="radio" name="gender">True or False</label>
                     </div>
                  </div>
               </div>

               <!-- Vertical Question Type -->

               <!--

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Question Type</label>

                  <div class="col-md-7">
                     <div class="radio">
                        <label><input type="radio" name="gender">Multiple Choice</label>
                     </div>
                  </div>

                  <div class="col-md-7">
                     <div class="radio">
                        <label><input type="radio" name="gender">Descriptive</label>
                     </div>
                  </div>

                  <div class="col-md-7">
                     <div class="radio">
                        <label><input type="radio" name="gender">True or False</label>
                     </div>
                  </div>

               </div>

               -->

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Number of Items</label>
                  <div class="col-md-7">
                     <input type="number" class="form-control" placeholder="1-100" min="1" max="100">
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-2 col-md-offset-5">
                     <button class="btn-block">Generate</button>
                  </div>
               </div>
               
            </form>
            
         </section>

      </div>

      <footer class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
            <p class="text-center" style="padding: 10px;">© 2024 Automated Exam. All rights reserved.</p>
         </div>
      </footer>

   </body>
</html>