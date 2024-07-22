function toggleFAQ(element) {
    var answer = element.nextElementSibling;

    if (answer.style.display === 'block') {
        answer.style.display = 'none';
        element.classList.remove('active');
    } else {
        answer.style.display = 'block';
        element.classList.add('active');
    }
}