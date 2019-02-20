<?php
/*
Template Name: Single choco label
*/
?>

<?php get_header();
$product_name = $_POST['label-search'];

    $query = new AirpressQuery();
    $query->setConfig("config");
    $query->table("Products");
    $query->addFilter("{PRODUCTNAME} = '{$product_name}'");

    $res  = new AirpressCollection($query);
    $k = $res[0];
?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main choco-main" role="main">

                <h1><?php echo $product_name ?></h1>

            <div class="temperature">
                <?php echo $k['Temperatur'];?>
            </div>
            <div class="table-top">
                <table>
                    <tr>
                        <th>Använd före:</th>
                        <th>Tillverkningsdatum:</th>
                        <th>Nettovikt</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $_POST['used-before'] ?>
                        </td>
                        <td>
                            <?php echo $_POST['manufacturing-date'] ?>
                        </td>
                        <td>
                            <?php echo $_POST['neto-weight'] ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="ingredients"><?php echo $k['INGREDIENTSTEXT']; ?></div>
            <div class="choco-tables-bottom">
                <div class="weigth-table">
                    <table>
                        <tr>
                            <th colspan="2">Näringsvärde per 100gr</th>

                        </tr>
                        <tr>
                            <td>Energi</td>
                            <td><?php echo $k['kj'].' kj/'.$k['kcal'].' kcal';?></td>
                        </tr>
                        <tr>
                            <td>Fett</td>
                            <td><?php echo $k[fat].' gr'; ?></td>
                        </tr>
                        <tr>
                            <td>-varav mättat fett</td>
                            <td><?php echo $k['saturated fat'].' gr';?></td>
                        </tr>
                        <tr>
                            <td>Kolhydrat</td>
                            <td><?php echo $k['carbo'].' gr';?></td>
                        </tr>
                        <tr>
                            <td>- varav sockerarter</td>
                            <td><?php echo $k['where of sugar'].' gr';?></td>
                        </tr>
                        <tr>
                            <td>Protein</td>
                            <td><?php echo $k['protein'].' gr';?></td>
                        </tr>
                        <tr>
                            <td>Salt</td>
                            <td><?php echo $k['salt'].' gr';?></td>
                        </tr>
                    </table>
                </div>
                <div class="barcode">
                    <div class="common-warning">
                        <?php echo $k['Common Warning'];?>
                    </div>
                    <img src="<?php print_r($k['Barcode'][0]['url']) ;?>" alt="">
                </div>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->
</div>

<?php get_footer();?>