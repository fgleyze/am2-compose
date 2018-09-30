import React from 'react';
import styled from 'styled-components';
import * as palette from '../../style/variables';

import { Link } from 'react-router-dom'

const Header = () => (
    <Nav className="navbar navbar-expand navbar-light justify-content-between">
      <Link brand to='/' className="navbar-brand">
          <Logo className="d-none d-md-block" src={'/img/am2-logo-large.jpg'}/>
          <Logo className="d-block d-md-none" src={'/img/am2-logo-small.jpg'}/>
      </Link>
      <ul className="navbar-nav">
          <li className="nav-item">
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
)

const Nav = styled.nav`
    font-size: 18px;
    margin: 25px 0;
`;

const Logo = styled.img`
    max-height: 35px;
`;

export default Header;
