import React, { Component } from 'react';
import { baseUrl } from '../../apiFetch/apiFetch';
import { fetchProjectDetail } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';

import BrickyGallery from '../../components/Project/BrickyGallery';

class ProjectDetail extends Component {
  	state = {
		project: {
            features: []
        },
		images: [],
        mainImage: []
	}

  	componentDidMount() {
		fetchProjectDetail(this.props.match.params.projectId)
			.then(project => this.setState({
				project: project,
				images: project.images,
                mainImage: project.images.filter(function( image ) { return image.position == 1; })[0]
			}))
	}

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
						<a href="#" className="js-photoswipe-link" data-loopindex="{{ forloop.index }}">
							<img src={ baseUrl + this.state.mainImage.imageUrl } className="img-fluid"/>
						</a>
					</div>

					<div className="col-lg-4">
						<Title className="am2-project-title">{this.state.project.title}</Title>
						<FeaturesList>
                            {console.log(this.state.project.features)}
                        {this.state.project.features.map( feature => {
                            return <li>
                                    {this.boldify(feature)}
                                </li>
                        })}
                        </FeaturesList>
						<Description className="am2-project-text"
						dangerouslySetInnerHTML={{__html:this.state.project.description}}></Description>
					</div>
				</Aligner>
			</div>
			<Hr/>
			<BrickyGallery images={this.state.images} />
	  </div>
	);
  }
}

const Aligner = styled.div`
	display: flex;
	align-items: center;
	justify-content: center;
`;

const Title = styled.h1`
	font-family: ${palette.secondary_font_family};
	margin: ${palette.spacing_unit__lg} 0;
`;

const FeaturesList = styled.ul`
	list-style-type: none;
		padding-left: 0;
		margin-bottom: ${palette.spacing_unit__xl};
	}

	li {
		margin: 4px 0;
	}
`;

const Description = styled.div`
	text-justify: inter-word;
	font-style: italic;
	padding-right: 30px;
`;

const Hr = styled.hr`
	border-top: 2px solid rgba(0,0,0,.15);
	max-width: 250px;
	margin: auto;
	margin-bottom: ${palette.spacing_unit__lg};
`;

export default ProjectDetail;
