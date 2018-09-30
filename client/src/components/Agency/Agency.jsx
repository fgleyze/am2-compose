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
      <div className="col-md-8 offset-md-2">
          <div id="js-agence-change" className="am2-agence-img">
              <img id="js-agence-serious" src={'/img/marin-1.jpg'} className="img-fluid"/>
              <img id="js-agence-fun" src={'/img/marin-2.jpg'} className="img-fluid"/>
          </div>
      </div>
      <div className="col-md-6 offset-md-3">
          <Content>
              <h1 dangerouslySetInnerHTML={{__html:this.state.agency.title}}></h1>
              <p dangerouslySetInnerHTML={{__html:this.state.agency.description}}></p>
          </Content>
      </div>
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
    margin-bottom: ${palette.spacing_unit__xl};
`;

const Content = styled.div`
    text-align: justify;
    text-justify: inter-word;

    h1 {
        font-family: ${palette.secondary_font_family};
        margin: ${palette.spacing_unit__xl} 0 ${palette.spacing_unit__lg} 0;
        text-align: center;
    }
`;

export default Agency;
