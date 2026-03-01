const steps = document.querySelectorAll(".step");
const stepIndicator = document.querySelectorAll(".step-indicator");

let currentStepInForm = 0;

function showStep(step) {
    stepIndicator.forEach((indicator, index) => {
        indicator.classList.toggle("active", index === step);
        indicator.classList.toggle("completed", index < step);
    });
    steps.forEach((stepElement, index) => {
        stepElement.classList.toggle("active", index === step);
    });

    document.getElementById("previousBtn").disabled = step === 0;

    if (step === steps.length - 1) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "inline-block";
    } else {
        document.getElementById("nextBtn").style.display = "inline-block";
        document.getElementById("submitBtn").style.display = "none";
    }
}

/**
 * NextStep()
 */
function nextStep() {
    if (currentStepInForm < steps.length - 1) {
        currentStepInForm++;
        showStep(currentStepInForm);
    }
}

/**
 * prevStep()
 */
function prevStep() {
    if (currentStepInForm > 0) {
        currentStepInForm--;
        showStep(currentStepInForm);
    }
}
