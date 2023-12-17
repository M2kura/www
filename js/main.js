const welcome = document.querySelector('h1');
    const form = document.querySelector('.sign-in-form');
    welcome.style.opacity = 0;
    form.style.opacity = 0;

    const fadeIn = (element, delay) => {
        let opacity = 0;
        const timer = setInterval(() => {
            if (opacity >= 1) {
                clearInterval(timer);
            } else {
                element.style.opacity = opacity;
                opacity += 0.04;
            }
        }, 50);
        if (element === welcome) {
            setTimeout(() => {
                fadeIn(form, 0);
            }, delay);
        }
    }

    setTimeout(() => {
        fadeIn(welcome, 2500);
    }, 1000); // 1000 milliseconds equals 2 seconds