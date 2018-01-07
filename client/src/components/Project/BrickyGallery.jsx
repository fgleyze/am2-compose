import React, { Component}  from 'react';
import { baseUrl } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';
// import Am2Swipe from '../../components/Project/Am2Swipe';

import 'photoswipe/dist/photoswipe.css';

import { Link } from 'react-router-dom'

class BrickyGallery extends Component {
	render() {
        const {
            images,
        } = this.props;

        let isOpen = true;

        const items = images.map( image => {
			return {
				src: 'http://lorempixel.com/1200/900/sports/1',
				w: 1637,
				h: 1056,
				title: 'Image 1'
			}
		})

		const items2 = [
			{
				src: 'http://lorempixel.com/1200/900/sports/1',
				w: 1200,
				h: 900,
				title: 'Image 1'
			},
			{
				src: 'http://lorempixel.com/1200/900/sports/2',
				w: 1200,
				h: 900,
				title: 'Image 2'
			}
		];

		// <Am2Swipe isOpen={isOpen} items={items}/>

		return (
			<Gallery>
				{ images.map( image => {
					if (image.position <= 1) {
						return;
					}

					return <Image width={image.thumbWidth} height={image.thumbHeight}>
							<i></i>
							<img src={ baseUrl + image.thumbUrl }/>
						</Image>
				})}
			</Gallery>
	);
  }
}

const Gallery = styled.div`
	display: flex;
	flex-wrap: wrap;
	margin-bottom: ${palette.spacing_unit__lg};

	&::after {
		content: '';
		flex-grow: 1e4;
		min-width: 20%;
	}
`;

const Image  = styled.div.attrs({
	containerCalc: props => props.width*150/props.height,
	iCalc: props => (props.height / props.width * 100),
})`
	margin: 2px;
	position: relative;
	width: ${props => props.containerCalc}px;
	flex-grow: ${props => props.containerCalc};


	i {
		display: block;
		padding-bottom: ${props => props.iCalc}%;
	}

	img {
		position: absolute;
		top: 0;
		width: 100%;
		vertical-align: bottom;
	}
`;

export default BrickyGallery;
