<?php
    // --- Data Fetching and Validation ---
    $harvestId = isset($_GET['id']) ? basename($_GET['id']) : ''; // Get ID and sanitize

    if (empty($harvestId)) {
        header("Location: /when.php"); // Redirect if no ID
        exit;
    }

    $harvestsJsonPath = __DIR__ . '/harvests.json';
    
    if (!file_exists($harvestsJsonPath)) {
        die("Error: harvests.json not found in the root directory.");
    }

    $harvestsJson = file_get_contents($harvestsJsonPath);
    $harvests = json_decode($harvestsJson, true);

    // Find the specific harvest data
    $currentHarvest = null;
    foreach ($harvests as $h) {
        if ($h['id'] === $harvestId) {
            $currentHarvest = $h;
            break;
        }
    }

    // --- Page Not Found Handling ---
    if (!$currentHarvest) {
        $pageTitle = "Not Found";
        include 'partials/head.php';
        include 'partials/header.php';
        echo '<main><section class="page-content"><p class="error-message">Sorry, the requested harvest could not be found.</p><a href="/when.php" class="details-link" style="display:inline-block; margin-top:1rem;">Back to Harvests</a></section></main>';
        include 'partials/footer.php';
        include 'partials/scripts.php';
        exit;
    }

    // --- SEO & Page Data ---
    $pageTitle = $currentHarvest['title'];
    
    // Create a unique, keyword-rich meta description from the harvest data.
    $pageDescription = "View the complete harvest log for " . $currentHarvest['title'] . ". Learn about growing " . $currentHarvest['genetics'] . " using the " . $currentHarvest['method'] . " method. Key lesson: " . $currentHarvest['key_lesson'];
    
    // Set a specific social media sharing image from the harvest's thumbnail.
    // We remove 'th-' to link to the larger version for better social media display.
    $ogImage = '/when/' . $currentHarvest['id'] . '/' . str_replace('th-', '', $currentHarvest['thumbnail']);


    // --- Page Structure ---
    include 'partials/head.php';
    include 'partials/header.php';
?>

<main>
    <section class="page-header">
        <div class="breadcrumb">
            <a href="/">Home</a> > <a href="/when.php">When</a> > <span><?php echo htmlspecialchars($currentHarvest['title']); ?></span>
        </div>
        <h1><?php echo htmlspecialchars($currentHarvest['title']); ?></h1>
    </section>

    <section class="page-content">
        <div class="key-lesson-box">
            <strong>Key Lesson:</strong>
            <?php echo htmlspecialchars($currentHarvest['key_lesson']); ?>
        </div>

        <div class="harvest-stats">
            <h3>Quick Stats</h3>
            <ul>
                <li><span>Genetics</span> <span><?php echo htmlspecialchars($currentHarvest['genetics']); ?></span></li>
                <li><span>Method</span> <span><?php echo htmlspecialchars($currentHarvest['method']); ?></span></li>
                <?php foreach($currentHarvest['stats'] as $key => $value): ?>
                    <li>
                        <span><?php echo ucwords(str_replace('_', ' ', $key)); ?></span>
                        <span><?php echo htmlspecialchars($value); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="image-gallery">
            <?php if (!empty($currentHarvest['images'])): ?>
                <?php foreach ($currentHarvest['images'] as $image): 
                    $fullImagePath = "/when/" . htmlspecialchars($currentHarvest['id']) . "/" . htmlspecialchars($image);
                    $thumbImagePath = "/when/" . htmlspecialchars($currentHarvest['id']) . "/th-" . htmlspecialchars($image);
                ?>
                    <div class="gallery-item">
                        <a href="<?php echo $fullImagePath; ?>" data-caption="<?php echo htmlspecialchars($currentHarvest['title']); ?> - <?php echo htmlspecialchars($image); ?>">
                            <img src="<?php echo $thumbImagePath; ?>" alt="Image from the <?php echo htmlspecialchars($currentHarvest['title']); ?> harvest">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="info-message">No additional images for this harvest.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
    include 'partials/footer.php';
    include 'partials/scripts.php';
?>