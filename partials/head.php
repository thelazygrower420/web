<!--
    File: head.php
    Project: theLazyGrower
    Description: Reusable head module with full SEO and Social Meta Tags.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
        // --- SEO & Social Meta Tag Variables ---
        // Set default values. These will be overridden by individual pages.
        $pageTitle = isset($pageTitle) ? $pageTitle . ' - theLazyGrower' : 'theLazyGrower - Efficient Cannabis Cultivation';
        $pageDescription = isset($pageDescription) ? $pageDescription : 'A demonstration of growing and life techniques focused on efficiency and balancing effort with reward.';
        $ogImage = isset($ogImage) ? $ogImage : '/images/og-image.jpg'; // A default social sharing image
        $ogUrl = 'https://www.thelazygrower.com' . $_SERVER['REQUEST_URI'];
    ?>

    <!-- Primary Meta Tags -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($ogUrl); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:image" content="https://www.thelazygrower.com<?php echo htmlspecialchars($ogImage); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo htmlspecialchars($ogUrl); ?>">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="twitter:image" content="https://www.thelazygrower.com<?php echo htmlspecialchars($ogImage); ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Favicon and Manifest Links -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
</head>
<body>
    <div class="site-wrapper">