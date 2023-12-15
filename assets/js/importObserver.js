/**
 * Import JS file when target is in viewport
 * @param target - DOM element
 * @param file - name of file without extension and ./, root is ./assets/js
 */
function importObserver(target, file) {
	// import when target is in viewport
	const observer = new IntersectionObserver(async (entries) => {
		if (entries[0].isIntersecting) {
			await import(`./${file}.js`);
			// stop observing
			observer.disconnect();
		}
	});
	observer.observe(target);
}

export default importObserver;
