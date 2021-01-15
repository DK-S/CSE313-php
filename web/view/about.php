<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/styles.css" media="screen">
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php';?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <h1>About</h1>
    <section>
      <article>
        <h2>Family</h2>
        <p>I love to spend time with my family. During the COVID-19 months, we have been able to hang out and watch lots of movies and TV shows. I can't wait till we are able we will get back out to doing more things away form the house.</p>
        <img src="images/family_500.jpg" alt="Family Photo">
      </article>
      <article>
        <h2>Trains</h2>
        <p>I love to model and run trains. Watching a train can be mesmerising. If you don't belive me, the next time you have a train show in your area, check it out.</p>
        <img src="images/train_500.jpg" alt="Train Photo">
      </article>
      <article>
        <h2>Planes and Helicopters</h2>
        <p>I love to fly. I cannot afford a pilots license, nor can I put forth the time it takes to get one. So I settled on the model route. Getting out and fying helps me feel the thrill of actually being up in the air, especially when there is a camera onboard.</p>
        <img src="images/helicopters_500.jpg" alt="Models of helicopters">
      </article>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php';?>
    </footer>
  </body>
</html>