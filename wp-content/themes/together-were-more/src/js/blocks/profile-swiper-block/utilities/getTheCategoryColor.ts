/**
 * Gets the color associated with a given category name.
 *
 * @param categoryName the category name
 * @returns
 */
export default function getTheCategoryColor( categoryName: string ): string {
	const colorMap = {
		Artists: 'gold',
		Culture: 'plum',
		Inspirational: 'violet',
		Competitors: 'garnet',
	};
	if ( ! categoryName || categoryName === '' ) {
		return 'gray';
	}
	if ( ! colorMap[ categoryName ] ) {
		throw new Error(
			`Category '${ categoryName }' not found in color map.`
		);
	}
	return colorMap[ categoryName ];
}
