import { Path, SVG } from '@wordpress/components';

const renderIcon = ( svg, width = 24, height = 24, viewbox = '0 0 24 24' ) => (
	<SVG
		xmlns="http://www.w3.org/2000/svg"
		width={ width }
		height={ height }
		viewBox={ viewbox }
	>
		<Path fill="none" d="M0 0h24v24H0V0z" className="icon-filler" />
		{ svg }
	</SVG>
);

export default renderIcon;
