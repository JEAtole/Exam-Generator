<!DOCTYPE html>
<html>
   <head>
      <title>Exam Gen</title>
      <link rel="stylesheet" href="../../css/bootstrap.min.css">
      <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="../../js/jquery.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
   </head>

   <body>
      
      <!-- Navbar -->

      <nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 50px;">
         <div class="container">

            <div class="navbar-header">
               <div class="navbar-brand"><a href="#" data-toggle="modal" data-target="#confirmationModal">NEUPaperTrail</a></div>
            </div>

            <ul class="nav navbar-nav navbar-right">
               <li><a href="#" data-toggle="modal" data-target="#confirmationModal">HOME</a></li>
            </ul>

         </div>
      </nav>

      <!-- Modal -->
      <div class="modal fade" id="confirmationModal">
         <div class="modal-dialog">
            <div class="modal-content">

               <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">Confirmation</h5>

               </div>

               <div class="modal-body">
                  Are you sure you want to go back to home page? <br/>
                  The data you submitted or exam progress will be deleted.
               </div>

               <div class="modal-footer">
                  
                  <form action="../../">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-danger">Go back to home page</button>
                  </form>   
               </div>

            </div>
         </div>
      </div>

      <!-- Use javascript to automatically put details -->

      <div class="container-fluid">  
         <section class="d-flex align-items-center justify-content-center">

            <div class="pos-rel">
               <h1 id="header" class="page-header"></h1>
               <button class="quit fix-right"><a href="../../menu/">QUIT</a></button>
            </div>

            <br/>

            <div>
               <h3 id="question" class="text-center">Insert question here.</h4>
               <br/>
               <div class="flex-box">
                  <button id="true" value="0" onclick="selectChoice(this)" class="sm-box">TRUE</button>
                  <button id="false" value="1" onclick="selectChoice(this)" class="sm-box">FALSE</button>

               </div>
               <br/>
               <div class="col-md-2 col-md-offset-3">
                  <button id="submit-button" type="button" class="btn btn-block">Submit</button>
               </div>
               <div id="button-container">
                  <div class="col-md-2 col-md-offset-2">
                     <button id="next-button" type="button" class="btn btn-block" disabled onclick="nextQuestion()">Next</button>
                  </div>
               </div>
            </div>



         </section>
      </div>

      <footer class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
            <p class="text-center" style="padding: 10px;">Automated Quiz Generator</p>
         </div>
      </footer>

   </body>
   <script src="script-tof.js"></script>
</html>