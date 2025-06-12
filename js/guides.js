/*
    File: guides.js
    Project: theLazyGrower
    Version: 1.0.0
    Creation Date: 2023-10-28
    Contributor: massEntropy
    Description: Handles dynamic fetching, rendering, and filtering of guide files.
*/

document.addEventListener('DOMContentLoaded', () => {
    const fileListContainer = document.getElementById('file-list-container');
    const searchInput = document.getElementById('search-input');
    const sortOrder = document.getElementById('sort-order');
    const filterType = document.getElementById('filter-type');
    const filterToggleButton = document.getElementById('filter-toggle-button');
    const filterPanel = document.getElementById('filter-panel');
    let allFiles = []; // To store the master list of files

    // --- Fetch and Render Initial Data ---
    // This fetches from the PHP script that scans the directory.
    // To use the local JSON file instead, change this to 'file-manifest.json'.
    fetch('get_files.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            allFiles = data;
            updateDisplay(); // Initial render
        })
        .catch(error => {
            console.error("Could not fetch guide files:", error);
            fileListContainer.innerHTML = `<p class="error-message">Could not load guide files. Please try again later.</p>`;
        });
        
    // --- Main Display Function ---
    function updateDisplay() {
        let filesToDisplay = [...allFiles];

        // 1. Filter by Search Term
        const searchTerm = searchInput.value.toLowerCase();
        if (searchTerm) {
            filesToDisplay = filesToDisplay.filter(file => 
                file.title.toLowerCase().includes(searchTerm) || 
                file.description.toLowerCase().includes(searchTerm)
            );
        }

        // 2. Filter by Type
        const type = filterType.value;
        if (type !== 'all') {
            filesToDisplay = filesToDisplay.filter(file => file.type === type);
        }

        // 3. Sort
        const sort = sortOrder.value;
        filesToDisplay.sort((a, b) => {
            if (sort === 'alpha-asc') {
                return a.title.localeCompare(b.title);
            } else if (sort === 'alpha-desc') {
                return b.title.localeCompare(a.title);
            }
            return 0;
        });

        // 4. Render
        renderFiles(filesToDisplay);
    }

    // --- Render Helper Function ---
    function renderFiles(files) {
        fileListContainer.innerHTML = ''; // Clear existing list

        if (files.length === 0) {
            fileListContainer.innerHTML = `<p class="info-message">No guides match your criteria.</p>`;
            return;
        }

        files.forEach(file => {
            const fileItem = document.createElement('a');
            fileItem.href = `files/${file.filename}`;
            fileItem.className = 'file-item card';
            fileItem.target = '_blank'; // Open in new tab
            fileItem.rel = 'noopener noreferrer';

            fileItem.innerHTML = `
                <div class="file-item-header">
                    <h3 class="file-title">${file.title}</h3>
                    <span class="file-type-badge type-${file.type}">${file.type.toUpperCase()}</span>
                </div>
                <p class="file-description">${file.description}</p>
                <span class="file-name-meta">${file.filename}</span>
            `;
            fileListContainer.appendChild(fileItem);
        });
    }

    // --- Event Listeners ---
    searchInput.addEventListener('input', updateDisplay);
    sortOrder.addEventListener('change', updateDisplay);
    filterType.addEventListener('change', updateDisplay);

    if (filterToggleButton) {
        filterToggleButton.addEventListener('click', () => {
            const isCollapsed = filterPanel.classList.toggle('collapsed');
            filterToggleButton.setAttribute('aria-expanded', !isCollapsed);
        });
    }
});