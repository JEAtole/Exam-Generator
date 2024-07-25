<!DOCTYPE html>
<html>
   <head>
      <title>Exam Gen</title>
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="styles.css">
      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
   </head>

   <body>

      <?php
      
         session_start(); 
         
         $customInfo = $_SESSION['customInfo'];
         $title = $customInfo['title'];
         $difficulty = $customInfo['difficulty'];
         $type = $customInfo['type'];
         $q_type = $customInfo['q_type'];
         $items = $customInfo['items'];

      ?>
      
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
                  Are you sure you want to go back to the home page? <br/>
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
      
      <!-- Title Part And Content-->
      <div class="container-fluid">  
         <section class="d-flex align-items-center justify-content-center">
            <div class="text-center">
                <h1><strong>Main Menu</strong></h1>
                <p> </p>

                <br/>

                <?php

                    switch($type) {
                        case "mcq":
                            $next_page = "../quiz/mcq/";
                            break;
                        case "tof":
                            $next_page = "../quiz/tof/";
                            break;
                        case "owa":
                            $next_page = "../quiz/owa/";
                            break;
                    }

                    echo "<form action='$next_page'>
                            <div class='col-md-2 col-md-offset-5'>
                                <button id='quiz' type='submit' class='btn btn-block'>Retake</button>
                            </div>
                            </form>"
                ?>

               <br/><br/><br/>

               <div class='col-md-2 col-md-offset-5'>
                  <button id="download" class="btn btn-block" onclick="downloadFile('<?php echo $type; ?>', '<?php echo $title; ?>')">Download as PDF</button>
               </div>
               
            </div>
         </section>

         <section>
            <?php
               echo "<div class='text-center'>";
               echo "<h3><strong>Title: </strong></h3><h4>$title</h4>";
               echo "<h3><strong>Difficulty: </strong></h3><h4>$difficulty</h4>";
               echo "<h3><strong>Quiz Type: </strong></h3><h4>$q_type </h4>";
               echo "<h3><strong>Number of Questions: </strong></h3><h4>$items</h4>";
               echo "</div>";
            ?>
         </section>
      </div>

      <footer class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
            <p class="text-center" style="padding: 10px;">Automated Quiz Generator</p>
         </div>
      </footer>

   </body>
   <script src="../js/download.js"></script>
</body>
</html>
