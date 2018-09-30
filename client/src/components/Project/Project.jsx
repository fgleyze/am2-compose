import React, { Component } from 'react';
import PropTypes from 'prop-types';
import styled from 'styled-components';
import { baseUrl } from '../../apiFetch/apiFetch';
import * as palette from '../../style/variables';
import ImageGallery from '../../components/Project/ImageGallery';
import ImageFullscreen from '../../components/Project/ImageFullscreen';

class Project extends Component {
    static propTypes = {
        projectTitle: PropTypes.string.isRequired,
        projectDescription: PropTypes.string.isRequired,
        projectFeatures: PropTypes.array.isRequired,
        mainImage: PropTypes.object.isRequired,
        images: PropTypes.array.isRequired,
        isGalleryOpened: PropTypes.bool.isRequired,
        openedImageUrl: PropTypes.string.isRequired,
        onGalleryOpening: PropTypes.func.isRequired,
		onGalleryClosing: PropTypes.func.isRequired,
	};

    boldify(feature) {
        if (!feature.includes(":")) {
            return <b> {feature} </b>;
        }

        const featureWithTitle = feature.split(":");

        return  <span><b>{featureWithTitle[0]}</b> {" :" + featureWithTitle[1]}</span>;
    }

    render() {
    	return (
            <div>
            	<div className="container-fluid section">
              		<Aligner className="row">
              			<div className="col-lg-8 am2-project-centered">
          					<img src={ baseUrl + this.props.mainImage.imageUrl } className="img-fluid d-none d-lg-block"/>
              			</div>

              			<div className="col-lg-4">
              				<Title className="am2-project-title">{this.props.projectTitle}</Title>
                      <MainImageMobile src={ baseUrl + this.props.mainImage.imageUrl } className="img-fluid d-block d-lg-none"/>
              				<FeaturesList>
                          {this.props.projectFeatures.map( feature => {
                              return <li>
                                      {this.boldify(feature)}
                                  </li>
                          })}
                      </FeaturesList>
              				<Description
                        className="am2-project-text"
          				      dangerouslySetInnerHTML={{__html:this.props.projectDescription}}
                      />
              			</div>
              		</Aligner>
            	    <Hr/>
                	<ImageGallery
                        images={this.props.images}
                        onGalleryOpening={this.props.onGalleryOpening}
                    />
                </div>
                {this.props.isGalleryOpened && <ImageFullscreen
                    imageUrl={this.props.openedImageUrl}
                    onGalleryClosing={this.props.onGalleryClosing}
                />}
            </div>
        );
    }
}

const Aligner = styled.div`
	display: flex;
	align-items: center;
	justify-content: center;
  margin-bottom: ${palette.spacing_unit__lg};
`;

const Title = styled.h1`
	font-family: ${palette.secondary_font_family};
	margin: ${palette.spacing_unit__lg} 0;
`;

const MainImageMobile = styled.img`
	margin-bottom: ${palette.spacing_unit__lg};
`;

const FeaturesList = styled.ul`
	list-style-type: none;
		padding-left: 0;
		margin-bottom: ${palette.spacing_unit__xl};
	}

	li {
		margin: 4px 0;
	}

  @media (max-width: ${palette.md_laptop}) {
      margin-bottom: ${palette.spacing_unit__md};
  }
`;

const Description = styled.div`
	text-justify: inter-word;
  text-align: justify;
	padding-right: 30px;
`;

const Hr = styled.hr`
	border-top: 2px solid rgba(0,0,0,.15);
	max-width: 250px;
	margin: auto;
	margin-bottom: ${palette.spacing_unit__lg};
`;

export default Project;
