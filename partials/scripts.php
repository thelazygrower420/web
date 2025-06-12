<!--
    File: scripts.php
    Project: theLazyGrower
    Description: Reusable scripts module with new Age Gate Modal HTML.
-->
    </div> <!-- .site-wrapper -->

    <!-- Age Gate Modal Structure -->
    <div id="age-gate-overlay" class="age-gate-overlay">
        <div class="age-gate-modal">
            <h2>Age Verification</h2>
            <p>Please confirm you are 21 years of age or older to enter this site.</p>
            <div class="age-gate-buttons">
                <button id="age-gate-yes" class="button-primary">Yes, I am 21+</button>
                <button id="age-gate-no" class="button-secondary">No, I am not</button>
            </div>
        </div>
    </div>

    <!-- JavaScript (Root-relative paths) -->
    <script src="/js/utils.js"></script>
    <script src="/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js" async></script>
    <script>
      // Initialize the lightbox
      window.addEventListener('load', function() {
        if (typeof baguetteBox !== 'undefined') {
          baguetteBox.run('.image-gallery, .harvest-grid');
        }
      });
    </script>
    
    <?php
    // Include page-specific scripts if the variable is set
    if (isset($pageScripts)) {
        echo $pageScripts;
    }
    ?>
</body>
</html>