import React, { Component } from 'react';
import { baseUrl, fetchContact } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';

class Contact extends Component {
	state = {
		contact: [],
		associates: []
	}

	componentDidMount() {
		fetchContact()
			.then(contact => this.setState({
				contact : contact,
				associates : contact.associates
			}))
	}

	render() {
		return (
			<Container className="row">
				<div className="col-md-6">
					<Illustration className="img-fluid"
						src={ baseUrl + this.state.contact.image }
					/>
				</div>
				<div className="col-md-6">
					<Card>
						<li><b>AM2</b> Architecture</li>
						<li><hr/></li>
						{ this.state.associates.map( associate => {
							return <CardContent><b>{ associate.firstName } { associate.lastName }</b> - { associate.phone }</CardContent>
						})}
						<CardContent>{ this.state.contact.address }</CardContent>
						<CardContent>{ this.state.contact.email }</CardContent>
					</Card>
				</div>
			</Container>
		);
	}
}

const Container = styled.div`
	@media (min-width: ${palette.md_laptop}) {
		align-items: center;
		display: flex;
		justify-content: center;
		margin-bottom: ${palette.spacing_unit__xl}
	}
`;

const Illustration = styled.img`
	@media (min-width: ${palette.md_laptop}) {
		float: right;
		max-height: 1000px;
	}

	@media (max-width: ${palette.md_laptop}) {
		display: none;
	}
`;

const Card = styled.ul`
	list-style-type: none;
	font-size: ${palette.font_size__lg};
	margin-top: calc(2 * ${palette.spacing_unit__lg});
`;

const CardContent = styled.li`
	font-size: 16px;
	margin-bottom: ${palette.spacing_unit__xs};
	font-style: italic;

	b {
		font-style: normal;
	}
`;

export default Contact;
