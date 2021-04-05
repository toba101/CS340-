<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php $ptitle = 'PHP Motors - Home';
    require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';
    ?>
</head>

<body>
    <div id="content">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        
		<nav><?php echo $navList;?> </nav>

        <main>
            <h1>Delete Review</h1>
            <p class="warning">Are you sure you want to delete this review? It cannot be restored once deleted.</p>
            <?php if (isset($message)) {
                echo $message;
            } ?>
            <form method="post" action="/phpmotors/reviews/index.php">
                <fieldset>
                    <legend>Delete Review</legend>
                    <label for="reviewDate">Date </label>
                    <input type="text" name="reviewDate" readonly value="<?php if (isset($reviewDetails)) {
                        //get date
                    $unix = strtotime($reviewDetails['reviewDate']);
                    $day = date("d", $unix);
                    $mo = date("m", $unix);
                    $yr = date("Y", $unix);
                    echo "$mo/$day/$yr";
                    } elseif (isset($_SESSION['reviewDetails'])) {
                    $unix = strtotime($_SESSION['reviewDetails']['reviewDate']);
                    $day = date("d", $unix);
                    $mo = date("m", $unix);
                    $yr = date("Y", $unix);
                    echo "$mo/$day/$yr";
                    } ?>" />
                    <label id="reviewScreenName">Screen Name </label>
                    <input type="text" name="reviewScreenName" readonly value="<?php if (isset($_SESSION['clientData'])) {
                        //get date
                    $screenName = buildScreenName();
                    echo "$screenName";
                    } ?>" />
                    <label for="reviewText">Review </label>
                    <textarea name="reviewText" readonly>
						<?php if (isset($reviewDetails)) {
                                    echo $reviewDetails['reviewText'];
                                    } elseif (isset($_SESSION['reviewDetails'])) {
                                    echo $_SESSION['reviewDetails']['reviewText'];
                                	} ?></textarea>
                    <input type="submit" name="submit" value="DELETE" class="primary-button">
                    <input type="hidden" name="action" value="confirmdelete">
                    <input type="hidden" name="reviewId" value="<?php if (isset($reviewId)) {
                                                                    echo $reviewId;
                                                                } elseif (isset($_SESSION['reviewDetails'])) {
                                                                    echo $_SESSION['reviewDetails']['reviewId'];
                                                                } ?>">
                </fieldset>
            </form>
        </main>

		<hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script></script>

</body>
</html>