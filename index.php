<?php
    require_once 'partials/functions.php';

    // --- SEO & Page Data ---
    $pageTitle = "Home";
    $pageDescription = "theLazyGrower is a project demonstrating efficient cannabis cultivation and life techniques. Learn to manage inputs to optimize outputs and enjoy the rewards.";

    $heroSlides = get_featured_content();
    $lowdownItems = get_lazy_lowdown_content();
    
    include 'partials/head.php';
    include 'partials/header.php';
?>

<main>
    <section class="hero">
        <div class="hero-slider">
			<?php if (!empty($heroSlides)): ?>
				<?php foreach ($heroSlides as $slide): 
					// Create the inline style attribute only if a hero image is set
					$bgStyle = !empty($slide['heroImage']) ? "style=\"background-image: url('" . htmlspecialchars($slide['heroImage']) . "');\"" : "";
				?>
					<div class="hero-slide" <?php echo $bgStyle; ?>>
						<div class="hero-slide-content">
							<h1><?php echo htmlspecialchars($slide['title']); ?></h1>
							<p><?php echo htmlspecialchars($slide['blurb']); ?></p>
							<a href="<?php echo htmlspecialchars($slide['link']); ?>" class="button-primary">Learn More</a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="hero-slide active">
					<div class="hero-slide-content">
						<h1>theLazyGrower</h1>
						<p>Managing Inputs to Optimize Outputs. Explore the site to learn more.</p>
					</div>
				</div>
			<?php endif; ?>
			
			<!-- Slider Controls -->
			<button class="slider-nav prev" aria-label="Previous Slide">❮</button>
			<button class="slider-nav next" aria-label="Next Slide">❯</button>
			<div class="slider-dots"></div>
		</div>
    </section>

    <section class="content-grid">
		<h2>The Lazy Lowdown</h2>
		<div class="grid-container">
			<?php
				$lowdown_items = get_lazy_lowdown_content();
				foreach ($lowdown_items as $item) {
					// Create the inline style attribute for the background image
					$bgStyle = !empty($item['heroImage']) ? "style=\"background-image: url('" . htmlspecialchars($item['heroImage']) . "');\"" : "";
					
					$cardClass = !empty($item['heroImage']) ? "card-with-bg" : "";

					echo '
					<article class="card ' . $cardClass . '" ' . $bgStyle . '>
						<div class="card-content-wrapper">
							<h3>' . htmlspecialchars($item['title']) . '</h3>
							<p>' . htmlspecialchars($item['blurb']) . '</p>
							<a href="' . htmlspecialchars($item['link']) . '" class="card-link">' . htmlspecialchars($item['link_text']) . '</a>
						</div>
					</article>';
				}
			?>
		</div>
	</section>
</main>

<?php
    include 'partials/footer.php';
    include 'partials/scripts.php';
?>