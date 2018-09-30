import React from 'react';
import styled from 'styled-components';
import * as palette from './style/variables';

import Header from './components/Navigation/Header';
import Main from './components/Navigation/Main';
import Footer from './components/Navigation/Footer';

const App = () => (
  <Container className="container">
    <Header />
    <Main />
    <Footer />
  </Container>
)

const Container = styled.div`
	font: ${palette.base_font_weight} ${palette.font_size__sm} ${palette.base_font_family};
`;

export default App;
