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
        	<FooterDiv className="d-block d-md-none">
            <a href={this.state.instagram} target="_blank">
              <img src={'/img/instagram_icon.svg'}/>
            </a>
            <a href={this.state.facebook} target="_blank">
              <img src={'/img/facebook_icon.svg'}/>
            </a>
            <a href={this.state.pinterest} target="_blank">
              <img src={'/img/pinterest_icon.svg'}/>
            </a>
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
      margin: 0 8px;
    }

    & > a > img {
      width: 25px;
      position: relative;
      display: inline-block;
    }

    a.svg {
      position: relative;
      display: inline-block;
    }
`;

export default Footer;
