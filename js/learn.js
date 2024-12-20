document.getElementById('quizForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let score = 0;
    const answers = {
        question1: 'a',
        question2: 'c',
        question3: 'a'
    };
    for (const [question, answer] of Object.entries(answers)) {
        const selectedAnswer = document.getElementById(question).value;
        if (selectedAnswer === answer) {
            score++;
        }
    }
    document.getElementById('score').innerText = `Your score is: ${score} out of ${Object.keys(answers).length}`;
});