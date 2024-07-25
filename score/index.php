<!DOCTYPE html>
<html>
   <head>
      <title>Exam Gen</title>
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
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
                  
                  <form action="../">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-danger">Go back to home page</button>
                  </form>   
               </div>

            </div>
         </div>
      </div>
      
      <!-- Title Part And Content -->

      <div class="container-fluid">  
         <section class="d-flex align-items-center justify-content-center">
            <div class="text-center">

               <?php

                  session_start();                  
                  $customInfo = $_SESSION['customInfo'];
                  $title = $customInfo['title'];
                  $score = $_POST['score'];
                  $noOfQuestions = $_POST['noOfQuestions'];
                  $percentage = ($score / $noOfQuestions) * 100;

                  echo "
                     <div id='quiz-header'>
                        <h1 class='page-header'>$title</h1>
                     </div>

                     <br/>

                     <h3>YOUR SCORE:</h3>
                     <h1>$percentage%</h1>
                     <h3>$score out of $noOfQuestions</h3>

                     <br/> <br/> <br/> <br/>

                  ";


               ?>

               <form action='../menu/'>
                  <div class='col-md-2 col-md-offset-5'>
                     <button id='quiz' type='submit' class='btn btn-block'>Menu</button>
                  </div>
               </form>

            </div>
         </section>
      </div>

      <footer class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
            <p class="text-center" style="padding: 10px;">Automated Quiz Generator</p>
         </div>
      </footer>

   </body>
</html>