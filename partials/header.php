<!--
    File: header.php
    Project: theLazyGrower
    Version: 1.6.0
    Description: Reusable header with robust click-to-open dropdown logic.
-->
<header>
    <div class="header-container">
        <a href="/" class="logo" title="theLazyGrower">
			<img src="/images/tlg-logo.png" alt="Logo" class="logo-image">
            <span class="logo-text">theLazyGrower</span>
        </a>
        <nav class="main-nav">
            <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
            <ul class="nav-links">
                <li><a href="/" title="Home:">Home</a></li>
				<li><a href="/when.php" title="When To">When</a></li>
                <li><a href="/where.php" title="Where To">Where</a></li>
                <li><a href="/why.php" title="Why To">Why</a></li>
                <li class="has-dropdown dropdown-right" title="How To">
                    <button class="nav-button" aria-haspopup="true" aria-expanded="false">How</button>
                    <ul class="dropdown">
                        <li><a href="/guides/decarb-cannabis.php">Decarboxylating Cannabis</a></li>
                        <li><a href="/guides/cannabis-infused-oils.php">Make Infused Oils & Solvents</a></li>
                        <li><a href="/guides/cannabis-infused-gummies.php">DIY Cannabis Gummies</a></li>
                        <li><a href="/guides/cannabis-infused-chocolate.php">DIY Cannabis Chocolate</a></li>
						<li><a href="/guides/diy-dry-bud-tumbler.php">DIY Dry Bud Tumbler</a></li>
                    </ul>
                </li>
                
                <li>
                    <button id="theme-toggle" class="theme-toggle-button" aria-label="Toggle light and dark mode">
                        <img class="icon-sun" src="/images/icon-sun-100.png" alt="Sun icon for light mode" width="24" height="24">
                        <img class="icon-moon" src="/images/icon-moon-100.png" alt="Moon icon for dark mode" width="24" height="24">
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</header>