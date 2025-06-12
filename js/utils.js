/*
    File: utils.js
    Project: theLazyGrower
    Version: 1.0.0
    Creation Date: 2023-10-27
    Contributor: massEntropy
    Description: Utility functions for cookies, date/time, and analytics.
*/

/**
 * Updates the content of two specific elements with the current year and date/time.
 * @param {string} yearElementId - The ID of the element to update with the current year.
 * @param {string} datetimeElementId - The ID of the element to update with the current date and time.
 */
function updateDateTime(yearElementId, datetimeElementId) {
    const yearEl = document.getElementById(yearElementId);
    const datetimeEl = document.getElementById(datetimeElementId);
    
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }
    
    if (datetimeEl) {
        const now = new Date();
        const formattedDateTime = now.toISOString().slice(0, 19).replace('T', ' ');
        datetimeEl.textContent = formattedDateTime;
    }
}

/**
 * Sets a cookie.
 * @param {string} name - The name of the cookie.
 * @param {string} value - The value of the cookie.
 * @param {number} days - The number of days until the cookie expires.
 */
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
}

/**
 * Gets a cookie's value by name.
 * @param {string} name - The name of the cookie to retrieve.
 * @returns {string|null} The cookie value or null if not found.
 */
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/**
 * A simple placeholder for a tracking function.
 * @param {string} eventName - The name of the event to track.
 * @param {object} eventData - An object containing data about the event.
 */
function trackEvent(eventName, eventData = {}) {
    console.log(`[Tracking Event] Name: ${eventName}`, eventData);
}