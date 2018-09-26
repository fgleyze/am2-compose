import React, { Component}  from 'react';
import PropTypes from 'prop-types';
import { baseUrl } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';
import { Link } from 'react-router-dom'

class ImageGallery extends Component {
	static propTypes = {
		images: PropTypes.array.isRequired,
		onGalleryOpening: PropTypes.func.isRequired,
	};

	render() {
        const {
            images,
        } = this.props;

		return (
			<Gallery>
				{ images.map( image => {
					if (image.position <= 1) {
						return;
					}

					const imageUrl = baseUrl.concat(image.imageUrl);

					return <a href="#" onClick={(e) => {this.props.onGalleryOpening(e, imageUrl) }}>
						<Image width={image.thumbWidth} height={image.thumbHeight}>
							<i></i>
							<img src={ baseUrl + image.thumbUrl }/>
						</Image>
					</a>
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

export default ImageGallery;
