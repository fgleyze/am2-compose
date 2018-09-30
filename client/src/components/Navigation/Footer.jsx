import React, { Component } from 'react';
import { fetchSocial } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';

class Footer extends Component {
  	state = {
      facebook: '',
      pinterest: '',
      instagram: '',
  	}

  	componentDidMount() {
		fetchSocial()
      .then(payload => this.setState({
        facebook : payload.facebook,
        instagram : payload.instagram,
        pinterest : payload.pinterest,
      }))
	}

    render() {
    	return (
        	<FooterDiv>
            <a href={this.state.facebook} target="_blank"> Facebook </a> - <a href={this.state.instagram} target="_blank"> Instagram </a> - <a href={this.state.pinterest} target="_blank"> Pinterest </a>
          </FooterDiv>
        );
    }
}

const FooterDiv = styled.div`
    text-align: center;
    margin-bottom: ${palette.spacing_unit__xl};
    font-size: 16px;

    & > a {
      color: inherit;
    }
`;

export default Footer;
