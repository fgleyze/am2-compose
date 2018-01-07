import React from 'react';
import styled from 'styled-components';
import * as palette from '../../style/variables';

import { Link } from 'react-router-dom'

const Header = () => (
  <Container className="navbar navbar-light">
    <Nav className="am2-nav">
      <Link brand to='/' className="navbar-brand">
          <Logo className="hidden-sm-down" src={'/img/am2-logo-large.jpg'}/>
          <Logo className="hidden-md-up" src={'/img/am2-logo-small.jpg'}/>
      </Link>

      <ul className="nav navbar-nav pull-xs-right">
          <li className="nav-item active">
              <Link to='/projets' className="nav-link">Projets</Link>
          </li>
          <li className="nav-item">
              <Link to='/agence' className="nav-link">Agence</Link>
          </li>
          <li className="nav-item">
              <Link to='/contact' className="nav-link">Contact</Link>
          </li>
      </ul>
    </Nav>
  </Container>
)

const Container = styled.header`
    @media (min-width: ${palette.sm_palm}) {
        padding: ${palette.spacing_unit__lg} 50px;
    }
`;

const Nav = styled.nav`
    font-size: 18px;
`;

const Logo = styled.img`
    max-height: 35px;
`;

export default Header;
