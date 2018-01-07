import React  from 'react';
import { Switch, Route } from 'react-router-dom'

import ProjectList from '../../components/Project/ProjectList';
import ProjectDetail from '../../components/Project/ProjectDetail';
import Agency from '../../components/Agency/Agency';
import Contact from '../../components/Contact/Contact';

const Main = () => (
  <main>
    <Switch>
      <Route exact path='/' component={ProjectList}/>
      <Route exact path='/projets' component={ProjectList}/>
      <Route path='/projets/:projectId' component={ProjectDetail}/>
      <Route exact path='/agence' component={Agency}/>
      <Route exact path='/contact' component={Contact}/>
    </Switch>
  </main>
)

export default Main;
