import '../styles/components/who-we-are.scss';

const statementContainer = document.getElementById(
	'statement-word'
) as HTMLElement;
const statements = statementContainer
	.getAttribute('data-statements')!
	.split(',');

let index = 0;
setInterval(() => {
	// Start Fade-Out transition
	statementContainer.style.transition = 'opacity .5s';
	statementContainer.style.opacity = '0';

	// Wait for transition to complete
	setTimeout(() => {
		// Change statement
		statementContainer.textContent = statements[index] + '.';
		// Update index for next iteration
		index = index === statements.length - 1 ? 0 : index + 1;
		// Start Fade-In transition
		statementContainer.style.opacity = '1';
	}, 250);
}, 2000);
