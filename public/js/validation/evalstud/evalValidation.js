let currentCard = 1;
const totalCards = document.querySelectorAll('[id^="card-"]').length;

$(function () {

    function toggleNextButton() {
        // Check if current card's fields are valid
        const isCurrentCardValid = $(getCurrentCardSelector()).find("input, select").valid();
        document.getElementById("next-btn").enabled = !isCurrentCardValid;
    }
});

function updateProgressBar() {
    const progressPercentage = (currentCard / totalCards) * 100;
    document.getElementById("progress-bar").style.width = progressPercentage + "%";
    document.getElementById("progress-text").textContent = `Page ${currentCard} of ${totalCards}`;

    // Show or hide navigation buttons based on current card
    document.getElementById("back-btn").style.display = currentCard > 1 ? "inline-block" : "none";
    document.getElementById("next-btn").style.display = currentCard < totalCards ? "inline-block" : "none";
    
    // Show submit button only on the last card
    document.getElementById("submit-btn").style.display = currentCard === totalCards ? "inline-block" : "none";

    // Check field completion if on the last card
    if (currentCard === totalCards) {
        checkLastCardCompletion();
    }
}

// Check if all fields in the last card are filled out
function checkLastCardCompletion() {
    const lastCardFields = document.querySelectorAll(`#card-${totalCards} input, #card-${totalCards} select`);
    const allFilled = Array.from(lastCardFields).every(field => field.value.trim() !== "");
    
    // Enable submit button if all fields are filled
    document.getElementById("submit-btn").disabled = !allFilled;
}

// Move to the next card
function nextCard(cardNumber) {
    if (cardNumber > totalCards) return;

    if (!$(getCurrentCardSelector()).find("input, select").valid()) {
        validator.focusInvalid();
        return; // Stop moving to the next card if current card is invalid
    }

    // Hide current card and show the next one
    document.getElementById(`card-${currentCard}`).style.display = "none";
    document.getElementById(`card-${cardNumber}`).style.display = "block";
    
    currentCard = cardNumber;
    updateProgressBar();
}

// Move to the previous card
function prevCard(cardNumber) {
    if (cardNumber < 1) return;

    document.getElementById(`card-${currentCard}`).style.display = "none";
    document.getElementById(`card-${cardNumber}`).style.display = "block";
    
    currentCard = cardNumber;
    updateProgressBar();
}

// Helper to get the current card selector
function getCurrentCardSelector() {
    return `#card-${currentCard}`;
}

// Add event listeners to check field completion on input
document.querySelectorAll(`#card-${totalCards} input, #card-${totalCards} select`).forEach(field => {
    field.addEventListener('input', checkLastCardCompletion);
});

// Initialize the progress bar on page load
updateProgressBar();
