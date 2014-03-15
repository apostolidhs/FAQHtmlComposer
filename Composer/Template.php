<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>compilers</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/faq.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div class="container">

      <div class="page-header">
        <div class="jumbotron">
            <h2>HY-340 Γλώσσες και Μεταφραστές</h2>
            <div class="row">
              <div class="col-xs-6 col-sm-1">
                <h3>FAQ</h3>
              </div>
              <div class="col-xs-6 col-sm-offset-7 col-sm-4">
                <h3 class="">Διδάσκων: Α. Σαββίδης</h3>
              </div>
            </div>
        </div>
      </div>
        
        
        <div class="row">

            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">     
                    <li class="active"><a 
                           class="faq-cat"
                           id="cat-all"
                           href="#"> 
                           όλες 
                    </a></li> 
                    <?php foreach ($mds as $phasesFaq){ ?>
                            <li class=""><a 
                                   class="faq-cat"
                                   id="cat-<?= $phasesFaq['id'] ?>"
                                   > 
                                    <?= $phasesFaq['name'] ?> 
                            </a></li>                            
                    <?php } ?>
                </ul>
            </div>

            <div class="col-sm-9">
                
                <?php foreach ($mds as $phasesFaq){ ?>
                    <div class="list-group faq-phase active" 
                         id="ph-<?= $phasesFaq['id'] ?>">
                       <?php foreach ($phasesFaq['faqs'] as $faqs){ ?>   
                            <div class="faq-ansque" 
                                 id="ph-<?= $faqs['id'] ?>">
                                <a  class="list-group-item faq-que">
                                <h4 class="list-group-item-heading faq-que-msg">
                                    <?= $faqs['q'] ?>
                                    <span class="pull-right faq-expand-icon glyphicon glyphicon-chevron-down"></span>
                                </h4>
                                </a>
                                <div class="list-group-item-text faq-ans">
                                    <?= $faqs['a'] ?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                <?php  }?>

            </div>

        </div>

      <footer>
        <div class="row">

          <div class="col-sm-offset-3 col-sm-2 faq-ftr-col">
            <h4> Βοηθοί </h4>
            <p> I. Βαλσαμάκης </p>
            <p> Ε. Καρουζάκη </p>
            <p> Α. Κατωπόδης </p>
            <p> Γ. Αποστολίδης </p>
          </div>
          <div class="col-sm-2 faq-ftr-col">
            <h4> Συγγραφή FAQ</h4>
            <p> Γ. Γεωργαλής </p>
            <p> Α. Δημάκης </p>
            <p> Α. Στάμου </p>
          </div>
          <div class="col-sm-2 faq-ftr-col">
            <h4> Σχεδίαση FAQ </h4>
            <p> Γ. Αποστολίδης </p>
          </div>

        </div>
      </footer>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/faq.js"></script>
  </body>
</html>