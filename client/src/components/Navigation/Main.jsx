import React  from 'react';
import { Switch, Route } from 'react-router-dom'

import ProjectListContainer from '../../components/ProjectList/ProjectListContainer';
import ProjectContainer from '../../components/Project/ProjectContainer';
import Agency from '../../components/Agency/Agency';
import Contact from '../../components/Contact/Contact';

const Main = () => (
  <main>
    <Switch>
      <Route exact path='/' component={ProjectListContainer}/>
      <Route exact path='/projets' component={ProjectListContainer}/>
      <Route path='/projets/:projectId' component={ProjectContainer}/>
      <Route exact path='/agence' component={Agency}/>
      <Route exact path='/contact' component={Contact}/>
    </Switch>
  </main>
)

export default Main;
