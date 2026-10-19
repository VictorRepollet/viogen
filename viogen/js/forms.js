document.querySelectorAll(".data-form").forEach((form) => {
    const indicators = Array.from(form.querySelectorAll(".indicator"));
    const progress = form.querySelector("[data-indicator-progress]");

    if (!progress) {
        return;
    }

    const updateProgress = () => {
        const answeredCount = indicators.filter((indicator) =>
            indicator.querySelector('input[type="radio"]:checked')
        ).length;

        progress.textContent = `${answeredCount} de ${indicators.length} indicadores respondidos`;
    };

    form.addEventListener("change", updateProgress);
});
