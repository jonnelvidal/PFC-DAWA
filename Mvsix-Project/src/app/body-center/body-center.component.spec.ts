import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BodyCenterComponent } from './body-center.component';

describe('BodyCenterComponent', () => {
  let component: BodyCenterComponent;
  let fixture: ComponentFixture<BodyCenterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BodyCenterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BodyCenterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
