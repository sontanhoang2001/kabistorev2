<?php include 'inc/header.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add brand</h2>
        <div class="block copyblock">
            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?>
            <form action="add-brand" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Enter brand name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
<script src="js/brand.js"></script>
<script>
    add_Brand();
</script>