import React, { Component}  from 'react';
import { baseUrl } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';

import { Link } from 'react-router-dom'

const ProjectCard = ({ project }) => (
	<div className="col-lg-4">
		<Link className="am2-index-link" to={`/projets/${project.id}`}>
			<Vignette url={project.image}></Vignette>
			<Title>{ project.title }</Title>
		</Link>
	</div>
)

const Vignette = styled.img.attrs({
	url: props => props.url,
})`
	background-image: url('${baseUrl}${props => props.url}');
	background-repeat: no-repeat;
	background-position: center center;
	background-size: cover;
	width: 100%;
	height: 425px;

    @media (max-width: ${palette.md_laptop}) {
        height: 250px;
    }
`;

const Title = styled.h1`
	color: ${palette.link_color};
	font-size: ${palette.font_size__xl};
	font-family: ${palette.secondary_font_family};
	font-weight: 700;
	padding-top: ${palette.spacing_unit__md};
	margin-bottom: ${palette.spacing_unit__xl};
	text-align: center;

	&:hover {
		color: ${palette.link_color};
	}
`;

export default ProjectCard;