<?php
//
// File: functions.php
// Project: theLazyGrower
// Version: 1.6.0
// Description: Contains reusable PHP functions for the entire site.
//

/**
 * Scans directories for .php files and safely extracts metadata for the hero slider.
 *
 * @return array An array of featured content items.
 */
function get_featured_content() {
    $featuredItems = [];
    $scanDirs = ['.', 'guides/']; // Directories to scan relative to the root

    foreach ($scanDirs as $dir) {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . '/' . $dir . '*.php');
        if (empty($files)) continue;

        foreach ($files as $file) {
            $basename = basename($file);
            if (in_array($basename, ['index.php', 'get_files.php', 'harvest.php'])) {
                continue;
            }

            $content = file_get_contents($file);
            $titleFound = preg_match('/\$pageTitle\s*=\s*"(.*?)"/s', $content, $titleMatches);
            $blurbFound = preg_match('/\$pageBlurb\s*=\s*"(.*?)"/s', $content, $blurbMatches);
            $imageFound = preg_match('/\$heroImage\s*=\s*"(.*?)"/s', $content, $imageMatches);

            if ($titleFound && $blurbFound) {
                $link = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
                $featuredItems[] = [
                    'title'     => $titleMatches[1],
                    'blurb'     => $blurbMatches[1],
                    'link'      => $link,
                    'heroImage' => $imageFound ? $imageMatches[1] : '' 
                ];
            }
        }
    }
    
    shuffle($featuredItems);
    return $featuredItems;
}


/**
 * UPDATED: Dynamically builds the "Lazy Lowdown" section.
 *
 * @return array An array of the main site pages with their dynamic content.
 */
function get_lazy_lowdown_content() {
    $lowdownItems = [];
    $pillarPages = [
        'why.php'  => 'The "Why": Our Philosophy',
        'where.php' => 'The "Where": Grow Environments',
        'when.php'  => 'The "When": Harvest Logs'
    ];

    foreach ($pillarPages as $filename => $title) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $filename;

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            
            // Extract the blurb
            $blurb = preg_match('/\$pageBlurb\s*=\s*"(.*?)"/s', $content, $blurbMatches) ? $blurbMatches[1] : 'Click to learn more.';
            
            // Extract the hero image
            $heroImage = preg_match('/\$heroImage\s*=\s*"(.*?)"/s', $content, $imageMatches) ? $imageMatches[1] : '';

            // Determine the link text
            $link_text = 'Explore More →';
            if ($filename === 'why.php') $link_text = 'Learn the Philosophy →';
            if ($filename === 'where.php') $link_text = 'Explore the Environments →';
            if ($filename === 'when.php') $link_text = 'View Past Harvests →';

            $lowdownItems[] = [
                'title'     => $title,
                'blurb'     => $blurb,
                'link'      => '/' . $filename,
                'link_text' => $link_text,
                'heroImage' => $heroImage // Add the image to the array
            ];
        }
    }

    return $lowdownItems;
}

?>