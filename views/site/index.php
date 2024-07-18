<?php
/** @var yii\web\View $this */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker = Faker\Factory::create("ru_RU");

$this->title = 'Main Page';?>

<section style="display: flex; flex-direction: column; margin: 0 auto;">
  <h1>Hellow World</h1>
  <p style="width: 100%; text-align: justify;">
    <?php echo $faker->realText($maxNbChars = 200, $indexSize = 2);?>
  </p>
</section>


