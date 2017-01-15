import R from 'ramda';
import component from 'brookjs/component';
import events from 'brookjs/events';
import children from 'brookjs/children';
import render from 'brookjs/render';
import Repo from '../component/repo';
import { lineNumbersChangeAction, showInvisiblesChangeAction,
    themeChangeAction } from '../action';
import template from './highlighting.hbs';

export default component({
    render: render(template),
    events: events({
        onThemeChange: R.map(
            R.pipe(R.path(['target', 'value']), themeChangeAction)
        ),
        onLineNumbersChange: R.map(
            R.pipe(R.path(['target', 'checked']), lineNumbersChangeAction)
        ),
        onShowInvisiblesChange: R.map(
            R.pipe(R.path(['target', 'checked']), showInvisiblesChangeAction)
        ),
    }),
    children: children({
        repo: Repo
    })
});