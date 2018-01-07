import React, { Component } from 'react';
import { baseUrl, fetchAgency } from '../../apiFetch/apiFetch';
import styled from 'styled-components';
import * as palette from '../../style/variables';
import $ from 'jquery';

class Agency extends Component {
  state = {agency: []}

  componentDidMount() {
  	fetchAgency().then(agency => this.setState({ agency }))
    animateImages()
  }

  render() {
    return (
    <Container className="row">
        <Images id="js-agence-change" className="col-xl-6 am2-agence-img">
            <img id="js-agence-serious" src={'/img/marin-1.jpg'} className="img-fluid"/>
            <img id="js-agence-fun" src={'/img/marin-2.jpg'} className="img-fluid"/>
        </Images>
        <Content className="col-xl-5">
            <h1 dangerouslySetInnerHTML={{__html:this.state.agency.title}}></h1>
            <p dangerouslySetInnerHTML={{__html:this.state.agency.description}}></p>
        </Content>
    </Container>
    );
  }
}

function animateImages() {
    $("#js-agence-fun").hide();
    $(function(){
        $("#js-agence-change").hover(function(){
                $("#js-agence-serious").toggle();
                $("#js-agence-fun").toggle();
            }, function(){
                $("#js-agence-serious").toggle();
                $("#js-agence-fun").toggle();
        });
    });
    $( "#js-agence-change" ).click(function(){
        $("#js-agence-serious").toggle();
        $("#js-agence-fun").toggle();
    });
}

const Container = styled.div`
    @media (min-width: ${palette.xl_desktop}) {
      display: flex;
      align-items: center;
      justify-content: center;
    }
`;

const Images = styled.div`
    @media (min-width: ${palette.xl_desktop}) {
      max-width: 50%;
    }
`;

const Content = styled.div`
    font-style: italic;
    text-align: justify;
    text-justify: inter-word;

    h1 {
        font-family: ${palette.secondary_font_family};
        margin: ${palette.spacing_unit__lg} 0;
    }
`;

export default Agency;
