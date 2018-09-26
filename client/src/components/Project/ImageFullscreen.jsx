import React, { Component}  from 'react';
import PropTypes from 'prop-types';
import styled from 'styled-components';
import * as palette from '../../style/variables';

class ImageFullscreen extends Component {
	static propTypes = {
		imageUrl: PropTypes.string.isRequired,
		onGalleryClosing: PropTypes.func.isRequired,
	};

	render() {
        const {
            imageUrl,
            onGalleryClosing,
        } = this.props;

		return (
			<a href="#" onClick={(e) => {this.props.onGalleryClosing(e) }}>
				<Background>
	                <Image src={ imageUrl }/>
				</Background>
			</a>
	);
  }
}

const Background = styled.div`
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.95);
	padding: 20px;
`;

const Image = styled.img`
	max-height: calc(100% - 40px);;
    max-width: calc(100% - 40px);;
    width: auto;
    height: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
`;

export default ImageFullscreen;
