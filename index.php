<!DOCTYPE html>
<html lang="en">

   <head>
      <!-- Set the character encoding to UTF-8 -->
      <meta charset="UTF-8">
      <!-- Specify the compatibility mode for Internet Explorer -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Set the viewport to control the layout on mobile devices -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Set the title of the web page -->
      <title>Exam Gen</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>

      <script>
         
         var xhr = new XMLHttpRequest();
         var command = 'command=cleanup';
         xhr.open('POST', 'control.php', true); // Synchronous request
         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         xhr.send(command);
         
      </script>

   </head>

   <body>
      
      <!-- Navbar -->

      <nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 50px;">
         <div class="container">

            <div class="navbar-header">
               <div class="navbar-brand"><a href="#">NEUPaperTrail</a></div>
            </div>

            <ul class="nav navbar-nav navbar-right">
               <li class="active"><a href="#">HOME</a></li>

            </ul>

         </div>
      </nav>


      <!-- Title Part And File Upload-->

      <div class="container-fluid">  

         <section class="d-flex align-items-center justify-content-center row">

            <div class="text-center heading row">
               <h1 class="page-header">Automated Quiz Generator</h1>
            </div>  

            <div class="row">

               <h4 class="text-center">Select PDF files to upload</h4>

               <br/>

               <form id="fileUploadForm" action="control.php" method="POST" enctype="multipart/form-data" target="showUploads">

                  <div class="col-md-5 col-md-offset-3">
                     <input class="form-control" type="file" name="files[]" accept=".pdf" multiple>
                  </div>

                  <div class="col-md-2">
                     <button id="fileUploadButton" type="submit" class="btn">Upload</button>
                  </div>

               </form>

            </div>  

         </section>

         <!-- Files Uploaded -->

         <section class="row">

            <div class="text-center">
               <p>Note: Refresh the page to clear upload files</p>
            </div>

            <div class="container-fluid box col-md-6 col-md-offset-3">
               <h3 class="text-center" style="color: #FFFFFF;">Files Uploaded</h3>

               <div id="files-container">

                  <!-- Show files uploaded here -->
                  <iframe id="showUploads" name="showUploads"></iframe>

               </div>

            </div>

            <iframe name="hidden_iframe" style="display:none;"></iframe>
   
         </section>

         <!-- Customization -->

         <section class="row">
            <div class="text-center">
               <h2>Exam Customization</h2>
               <p>Supply the details and select from the options below.</p>
            </div>
            
            <br/>

            <form class="form-horizontal" action="quiz/" method="POST">

               <div class="form-group">
                  <label class="control-label col-md-2 col-md-offset-1">Title</label>
                  <div class="col-md-7">
                     <input type="text" class="form-control" name="title" placeholder="Set exam title here" required>
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Difficulty</label>
                  <div class="col-md-7">
                     <div class="radio">
                        <label><input type="radio" name="difficulty" value="Easy" required>Easy&nbsp;&nbsp;</label>
                        <label><input type="radio" name="difficulty" value="Average">Average&nbsp;&nbsp;</label>
                        <label><input type="radio" name="difficulty" value="Difficult">Difficult</label>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Question Type</label>
                  <div class="col-md-7">
                     <div class="radio">

                        <label><input type="radio" name="type" value="mcq" required>Multiple Choice&nbsp;&nbsp;</label>
                        <label><input type="radio" name="type" value="owa">Identification&nbsp;&nbsp;</label>
                        <label><input type="radio" name="type" value="tof">True or False</label>

                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label class=" control-label col-md-2 col-md-offset-1">Number of Items</label>
                  <div class="col-md-7">
                     <input type="number" name="items" class="form-control" placeholder="1-10" min="1" max="10" required>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-2 col-md-offset-5">
                     <button id="generateButton" type="submit" class="btn btn-block generate" disabled >Generate</button>
                  </div>
               </div>
               
            </form>
            
         </section>

      </div>

      <footer class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
            <p class="text-center" style="padding: 10px;">Automated Quiz Generator</p>
         </div>
      </footer>

   </body>

   <script src="script.js"></script>
</html>
