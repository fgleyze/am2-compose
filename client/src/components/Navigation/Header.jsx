import React, { Component } from 'react';
import { fetchSocial } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';
import { Link } from 'react-router-dom'

class Header extends Component {
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
        <Nav className="navbar navbar-expand navbar-light justify-content-between">
          <Link brand to='/' className="navbar-brand">
              <Logo className="d-none d-md-block" src={'/img/am2-logo-large.jpg'}/>
              <Logo className="d-block d-md-none" src={'/img/am2-logo-small.jpg'}/>
          </Link>
          <Am2Navigation className="navbar-nav">
              <li className="nav-item">
                  <Link to='/projets' className="nav-link">Projets</Link>
              </li>
              <li className="nav-item">
                  <Link to='/agence' className="nav-link">Agence</Link>
              </li>
              <li className="nav-item">
                  <Link to='/contact' className="nav-link">Contact</Link>
              </li>
              <li className="nav-item d-none d-md-block">
                  <SocialLink href={this.state.instagram} target="_blank" className="nav-link">
                    <img src={'/img/instagram_icon.svg'}/>
                  </SocialLink>
              </li>
              <li className="nav-item d-none d-md-block">
                  <SocialLink href={this.state.facebook} target="_blank" className="nav-link">
                    <img src={'/img/facebook_icon.svg'}/>
                  </SocialLink>
              </li>
              <li className="nav-item d-none d-md-block">
                  <SocialLink href={this.state.pinterest} target="_blank" className="nav-link">
                    <img src={'/img/pinterest_icon.svg'}/>
                  </SocialLink>
              </li>
          </Am2Navigation>
        </Nav>
        );
    }
}

const Nav = styled.nav`
    font-size: 18px;
    margin: 25px 0 30px 0;
`;

const Logo = styled.img`
    max-height: 35px;
`;

const SocialLink = styled.a`
    & img {
      width: 25px;
    }
`;

const Am2Navigation = styled.ul`
    @media (min-width: ${palette.md_laptop}) {
      font-size: 20px;
    }
`;

export default Header;
