import React, { Component } from 'react';
import { fetchProjectList } from '../../apiFetch/apiFetch';

import ProjectCard from '../../components/Project/ProjectCard';

class ProjectList extends Component {
  state = {projectList: []}

  componentDidMount() {
  	fetchProjectList().then(projectList => this.setState({ projectList }))
  }		

  render() {
    return (
      <div className="projectList">
      	{ this.state.projectList.map( project => {
      		return <ProjectCard project={project} />
      	})}
      </div>
    );
  }
}

export default ProjectList;