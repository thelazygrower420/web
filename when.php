<?php
    // --- SEO & Page Data ---
    $pageTitle = "When: Harvest Logs";
    $pageDescription = "Explore a visual gallery of past cannabis harvests from theLazyGrower. Each log is a case study detailing methods, genetics, and key lessons learned.";
    $pageBlurb = "Browse a visual gallery of past harvests, each with detailed logs and the key lessons learned.";
    $heroImage = "/images/hero-when.jpg";
    $harvestsJson = file_get_contents(__DIR__ . '/harvests.json');
    $harvests = json_decode($harvestsJson, true);

    include 'partials/head.php';
    include 'partials/header.php';
?>

<main>
    <section class="page-header">
        <div class="breadcrumb">
            <a href="/">Home</a> > <span>When</span>
        </div>
        <h1>When: A Gallery of Past Harvests</h1>
    </section>

    <section class="page-content">
        <p>This is a gallery of past grow cycles, serving as a visual logbook and a library of lessons learned. Each entry is a self-contained case study. Click any image to see it up close, or view the harvest log for detailed notes and stats.</p>
        
        <div class="harvest-grid">
            <?php if (!empty($harvests)): ?>
                <?php foreach ($harvests as $harvest): 
                    // Determine the image for the lightbox link.
                    // Use the FIRST image from the 'images' array if it exists.
                    $lightbox_image_url = '';
                    if (!empty($harvest['images'])) {
                        $lightbox_image_url = '/when/' . htmlspecialchars($harvest['id']) . '/' . htmlspecialchars($harvest['images'][0]);
                    } else {
                        // Fallback in case the images array is empty: use the full-size thumbnail.
                        $lightbox_image_url = '/when/' . htmlspecialchars($harvest['id']) . '/' . str_replace('th-', '', htmlspecialchars($harvest['thumbnail']));
                    }

                    // Define the other URLs as before.
                    $thumbnail_url = '/when/' . htmlspecialchars($harvest['id']) . '/' . htmlspecialchars($harvest['thumbnail']);
                    $detail_page_url = 'harvest.php?id=' . htmlspecialchars($harvest['id']);
                ?>
                    <div class="harvest-card">
                        <!-- Link for the LIGHTBOX now uses the reliable URL -->
                        <a href="<?php echo $lightbox_image_url; ?>" data-caption="<?php echo htmlspecialchars($harvest['title']); ?>">
                            <img src="<?php echo $thumbnail_url; ?>" alt="Thumbnail for <?php echo htmlspecialchars($harvest['title']); ?>" class="harvest-card-image">
                        </a>
                        <div class="harvest-card-content">
                            <h3><?php echo htmlspecialchars($harvest['title']); ?></h3>
                            <p><?php echo htmlspecialchars($harvest['genetics']); ?></p>
                            <!-- Link for the DETAIL PAGE remains the same -->
                            <a href="<?php echo $detail_page_url; ?>" class="details-link">View Harvest Log →</a>
                            <span class="method-tag"><?php echo htmlspecialchars($harvest['method']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="info-message">No harvests have been documented yet. Check back soon!</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
    include 'partials/footer.php';
    include 'partials/scripts.php';
?>