import React, { Component } from 'react';
import { fetchProjectDetail } from '../../apiFetch/apiFetch';
import Project from '../../components/Project/Project';

class ProjectContainer extends Component {
  	state = {
		project: {
            title: '',
            description: '',
            features: []
        },
		images: [],
        mainImage: [],
        isGalleryOpened: false,
        openedImageUrl: '',
	}

  	componentDidMount() {
		fetchProjectDetail(this.props.match.params.projectId)
			.then(project => this.setState({
				project: project,
				images: project.images,
                mainImage: project.images.filter(function( image ) { return image.position == 1; })[0]
			}))
	}

    onGalleryOpening = (e, imageUrl) => {
        e.preventDefault();

        this.setState({
            isGalleryOpened: true,
            openedImageUrl: imageUrl
        });
    };

    onGalleryClosing = (e) => {
        e.preventDefault();

        this.setState({
            isGalleryOpened: false,
            openedImageUrl: '',
        });
    };

    render() {
    	return (
        	<Project
                projectTitle={this.state.project.title}
                projectDescription={this.state.project.description}
                projectFeatures={this.state.project.features}
                mainImage={this.state.mainImage}
                images={this.state.images}
                isGalleryOpened={this.state.isGalleryOpened}
                openedImageUrl={this.state.openedImageUrl}
                onGalleryOpening={this.onGalleryOpening}
                onGalleryClosing={this.onGalleryClosing}
            />
        );
    }
}

export default ProjectContainer;
