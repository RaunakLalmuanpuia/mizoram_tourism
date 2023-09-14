import { createWebHistory, createRouter } from "vue-router";

import Layout from '../components/Layouts/Layout';

import ExampleComponent from '../components/ExampleComponent';

import AmenityComponent from '../components/amenity/Index';
import AmenityCreateComponent from '../components/amenity/Create';
import AmenityEdit from '../components/amenity/Edit';

import DistrictMeta from '../components/district-meta/Index';
import DistrictMetaCreate from '../components/district-meta/Create';
import DistrictMetaEdit from '../components/district-meta/Edit';

import Destination from '../components/destination/Index';
import DestinationCreate from '../components/destination/Create';
import DestinationEdit from '../components/destination/Edit';

import RoomType from '../components/room-type/Index';
import RoomTypeCreate from '../components/room-type/Create';
import RoomTypeEdit from '../components/room-type/Edit';


import Quote from '../components/quote/Index';
import QuoteCreate from '../components/quote/Create';
import QuoteEdit from '../components/quote/Edit';

import Lodge from '../components/lodge/Index';
import LodgeCreate from '../components/lodge/Create';
import LodgeEdit from '../components/lodge/Edit';
import LodgeStatement from '../components/lodge/Statements';

import Tag from '../components/tag/Index';
import TagCreate from '../components/tag/Create';
import TagEdit from '../components/tag/Edit';

import RoomMenu from '../components/room-data/Menu';
import Room from '../components/room-data/Index';
import RoomCreate from '../components/room-data/Create';
import RoomEdit from '../components/room-data/Edit';

import Booking from '../components/booking/Index';
import BookingShowAll from '../components/booking/IndexShowAll';

import BookingCreate from '../components/booking/Create';
import BookingGuest from '../components/booking/Guest';
import RoomAssign from '../components/booking/RoomAssign';
import CancelledBookings from '../components/booking/CancelledBookings';
import CancelledBookingDetail from '../components/booking/CancelledBookingDetail';
import FailedPayments from '../components/booking/FailedPayments';
import FailedPaymentDetail from '../components/booking/FailedPaymentDetail';
import LodgeCancelledBookings from '../components/booking/LodgeCancelledBookings';
import EditBooking from '../components/booking/Edit';

import Report from '../components/report/Create';
import ReportSubmit from '../components/report/ReportReview';
import ReportOffice from '../components/report/List';
import Dashboard from '../components/report/Dashboard';

import Guide from '../components/guide/Index';
import GuideCreate from '../components/guide/Create';
import GuideEdit from '../components/guide/Edit';

import Hotel from '../components/hotel/Index';
import HotelCreate from '../components/hotel/Create';
import HotelEdit from '../components/hotel/Edit';

import Restaurant from '../components/restaurant/Index';
import RestaurantCreate from '../components/restaurant/Create';
import RestaurantEdit from '../components/restaurant/Edit';

import Operator from '../components/operator/Index';
import OperatorCreate from '../components/operator/Create';
import OperatorEdit from '../components/operator/Edit';

import Rental from '../components/rental/Index';
import RentalCreate from '../components/rental/Create';
import RentalEdit from '../components/rental/Edit';

import Agent from '../components/agent/Index';
import AgentCreate from '../components/agent/Create';
import AgentEdit from '../components/agent/Edit';

import Distance from '../components/distance/Index';
import DistanceCreate from '../components/distance/Create';
import DistanceEdit from '../components/distance/Edit';

import About from '../components/about/Index';
import AboutCreate from '../components/about/Create';
import AboutEdit from '../components/about/Edit';

import Festival from '../components/festival/Index';
import FestivalCreate from '../components/festival/Create';
import FestivalEdit from '../components/festival/Edit';

import Information from '../components/information/Index';
import InformationCreate from '../components/information/Create';
import InformationEdit from '../components/information/Edit';

import Notice from '../components/notice/Index';
import NoticeCreate from '../components/notice/Create';
import NoticeEdit from '../components/notice/Edit';

import Mizoram from '../components/mizoram/Index';
import MizoramCreate from '../components/mizoram/Create';
import MizoramEdit from '../components/mizoram/Edit';

import NoticeCategory from '../components/notice-category/Index';
import NoticeCategoryCreate from '../components/notice-category/Create';
import NoticeCategoryEdit from '../components/notice-category/Edit';

import User from '../components/user/Index';
import UserCreate from '../components/user/Create';
import UserEdit from '../components/user/Edit';
import UserLodge from '../components/user/UserLodge';

import RatingList from '../components/rating/List';
import RatingIndex from '../components/rating/Index';

import Pledge from '../components/pledge/Index';

import Example from '../components/report/Example';

import VisitorDataReports from '../components/occupancy-statement/Create';
import VisitorDataReportList from '../components/occupancy-statement/List';
import VisitorDataReportDetail from '../components/occupancy-statement/Detail';
import OccupancyPreview from '../components/occupancy-statement/Preview';

import Category from '../components/category/Index';
import CategoryCreate from '../components/category/Create';
import CategoryEdit from '../components/category/Edit';

import Carousal from '../components/carousal/Index';
import CarousalCreate from '../components/carousal/Create';
import CarousalEdit from '../components/carousal/Edit';

import Home from '../components/home';

export const routes = [
  {
    path: '/admin/',
    component: Layout,
    children: [
      {
        name: 'home',
        path: '',
        component: Home,
      },
      {
        name: 'amenities',
        path: 'amenities',
        component: AmenityComponent
      },
      {
        name: 'amenityCreate',
        path: 'amenities/create',
        component: AmenityCreateComponent
      },
      {
        name: 'amenityEdit',
        path: 'amenities/:id',
        component: AmenityEdit
      },
      {
        name: 'districts',
        path: 'districts',
        component: DistrictMeta
      },
      {
        name: 'districtCreate',
        path: 'districts/create',
        component: DistrictMetaCreate
      },
      {
        name: 'districtEdit',
        path: 'districts/:id',
        component: DistrictMetaEdit
      },
      {
        name: 'destinations',
        path: 'destinations',
        component: Destination
      },
      {
        name: 'destinationCreate',
        path: 'destinations/create',
        component: DestinationCreate
      },
      {
        name: 'destinationsEdit',
        path: 'destinations/:id',
        component: DestinationEdit
      },

      //Room Type
      {
        name: 'types',
        path: 'types',
        component: RoomType
      },
      {
        name: 'typeCreate',
        path: 'types/create',
        component: RoomTypeCreate
      },
      {
        name: 'typesEdit',
        path: 'types/:id',
        component: RoomTypeEdit
      },

      {
        name: 'quotes',
        path: 'quotes',
        component: Quote
      },
      {
        name: 'quoteCreate',
        path: 'quotes/create',
        component: QuoteCreate
      },
      {
        name: 'quotesEdit',
        path: 'quotes/:id',
        component: QuoteEdit
      },
      // lodge
      {
        name: 'lodges',
        path: 'lodges',
        component: Lodge
      },
      {
        name: 'lodgeCreate',
        path: 'lodges/create',
        component: LodgeCreate
      },
      {
        name: 'lodgesEdit',
        path: 'lodges/:id',
        component: LodgeEdit
      },
      {
        name: 'lodgeRevenue',
        path: 'lodges/revenue-statement/:id',
        component: LodgeStatement,
      },

      //Room Data
      {
        name: 'roommenu',
        path: 'roommenu',
        component: RoomMenu
      },
      {
        name: 'rooms',
        path: 'rooms/:id/:district_id',
        component: Room
      },
      {
        name: 'roomCreate',
        path: 'rooms/create',
        component: RoomCreate
      },
      {
        name: 'roomsEdit',
        path: 'rooms/:id',
        component: RoomEdit
      },

      //Booking
      {
        name: 'bookings',
        path: 'bookings',
        component: Booking
      },
      {
        name: 'bookingsAll',
        path: 'bookings/all',
        component: BookingShowAll
      },
      {
        name: 'bookingCreate',
        path: 'bookings/create',
        component: BookingCreate,
      },
      {
        name: 'bookingGuest',
        path: 'bookings/guest/:id/:bookingId',
        component: BookingGuest,
      },
      {
        name: 'roomAssign',
        path: 'bookings/room-assign/:id',
        component: RoomAssign,
      },
      {
        name: 'viewCancelledBookings',
        path: 'cancelled-bookings/view/:id',
        component: CancelledBookings,
      },
      {
        name: 'cancelledBookings',
        path: 'cancelled-bookings',
        component: LodgeCancelledBookings,
      },
      {
        name: 'cancelledBookingDetail',
        path: 'cancelled-bookings/:id',
        component: CancelledBookingDetail,
      },
      {
        name: 'failedPayments',
        path: 'unconfirmed-bookings',
        component: FailedPayments,
      },
      {
        name: 'failedPaymentDetail',
        path: 'unconfirmed-bookings/detail/:id',
        component: FailedPaymentDetail,
      },
      {
        name: 'editBooking',
        path: 'edit-booking/:id',
        component: EditBooking,
      },

      //Report
      {
        name: 'reports',
        path: 'reports',
        component: Report,
      },
      {
        name: 'reportSubmit',
        path: 'reportsubmit',
        component: ReportSubmit,
      },
      {
        name: 'reportOffice',
        path: 'reportOffice',
        component: ReportOffice,
      },
      {
        name: 'dashboard',
        path: 'dashboard',
        component: Dashboard,
      },

      //Tag
      {
        name: 'tags',
        path: 'tags',
        component: Tag,
      },
      {
        name: 'tagCreate',
        path: 'tags/create',
        component: TagCreate,
      },
      {
        name: 'tagEdit',
        path: 'tags/:id',
        component: TagEdit,
      },


      //Guide
      {
        name: 'guides',
        path: 'guides',
        component: Guide,
      },
      {
        name: 'guideCreate',
        path: 'guides/create',
        component: GuideCreate,
      },
      {
        name: 'guideEdit',
        path: 'guides/:id',
        component: GuideEdit,
      },

      //Hotel
      {
        name: 'hotels',
        path: 'hotels',
        component: Hotel,
      },
      {
        name: 'hotelCreate',
        path: 'hotels/create',
        component: HotelCreate,
      },
      {
        name: 'hotelEdit',
        path: 'hotels/:id',
        component: HotelEdit,
      },

      //Restaurant
      {
        name: 'restaurants',
        path: 'restaurants',
        component: Restaurant,
      },
      {
        name: 'restaurantCreate',
        path: 'restaurants/create',
        component: RestaurantCreate,
      },
      {
        name: 'restaurantEdit',
        path: 'restaurants/:id',
        component: RestaurantEdit,
      },

      //Operator
      {
        name: 'operators',
        path: 'operators',
        component: Operator,
      },
      {
        name: 'operatorCreate',
        path: 'operators/create',
        component: OperatorCreate,
      },
      {
        name: 'operatorEdit',
        path: 'operators/:id',
        component: OperatorEdit,
      },

      //Rental
      {
        name: 'rentals',
        path: 'rentals',
        component: Rental,
      },
      {
        name: 'rentalCreate',
        path: 'rentals/create',
        component: RentalCreate,
      },
      {
        name: 'rentalEdit',
        path: 'rentals/:id',
        component: RentalEdit,
      },

      //Agent
      {
        name: 'agents',
        path: 'agents',
        component: Agent,
      },
      {
        name: 'agentCreate',
        path: 'agents/create',
        component: AgentCreate,
      },
      {
        name: 'agentEdit',
        path: 'agents/:id',
        component: AgentEdit,
      },

      //Distance
      {
        name: 'distances',
        path: 'distances',
        component: Distance,
      },
      {
        name: 'distanceCreate',
        path: 'distances/create',
        component: DistanceCreate,
      },
      {
        name: 'distanceEdit',
        path: 'distances/:id',
        component: DistanceEdit,
      },
      //FESTIVAL
      {
        name: 'festivals',
        path: 'festivals',
        component: Festival,
      },
      {
        name: 'festivalCreate',
        path: 'festivals/create',
        component: FestivalCreate,
      },
      {
        name: 'festivalEdit',
        path: 'festivals/:id',
        component: FestivalEdit,
      },

      //Distance
      {
        name: 'abouts',
        path: 'abouts',
        component: About,
      },
      {
        name: 'aboutCreate',
        path: 'abouts/create',
        component: AboutCreate,
      },
      {
        name: 'aboutEdit',
        path: 'abouts/:id',
        component: AboutEdit,
      },

      //Information
      {
        name: 'informations',
        path: 'informations',
        component: Information,
      },
      {
        name: 'informationCreate',
        path: 'informations/create',
        component: InformationCreate,
      },
      {
        name: 'informationEdit',
        path: 'informations/:id',
        component: InformationEdit,
      },

      //Notice
      {
        name: 'notices',
        path: 'notices',
        component: Notice,
      },
      {
        name: 'noticeCreate',
        path: 'notices/create',
        component: NoticeCreate,
      },
      {
        name: 'noticeEdit',
        path: 'notices/:id',
        component: NoticeEdit,
      },
      //Mizoram
      {
        name: 'mizorams',
        path: '/mizorams',
        component: Mizoram,
      },
      {
        name: 'mizoramCreate',
        path: '/mizorams/create',
        component: MizoramCreate,
      },
      {
        name: 'mizoramEdit',
        path: '/mizorams/:id',
        component: MizoramEdit,
      },

      //Categories
      {
        name: 'categories',
        path: '/categories',
        component: NoticeCategory,
      },
      {
        name: 'categoriesCreate',
        path: '/categories/create',
        component: NoticeCategoryCreate,
      },
      {
        name: 'categoriesEdit',
        path: '/categories/:id',
        component: NoticeCategoryEdit,
      },

      //TODO:RATING
      {
        name: 'ratingList',
        path: '/rating/list',
        component: RatingList,
        props: true
      },
      {
        name: 'ratingIndex',
        path: '/rating/index',
        component: RatingIndex,
        props: true,
      },

      // User
      {
        name: 'users',
        path: '/users',
        component: User,
      },
      {
        name: 'userCreate',
        path: '/users/create',
        component: UserCreate,
      },
      {
        name: 'userEdit',
        path: '/users/:id',
        component: UserEdit,
      },
      {
        name: 'userLodge',
        path: '/user-lodge',
        component: UserLodge,
      },
      // Pledge
      {
        name: 'pledges',
        path: '/pledges',
        component: Pledge,
      },
      // Visitor data report
      {
        name: 'visitorDataReports',
        path: '/visitor-data-reports',
        component: VisitorDataReports,
      },

      {
        name: 'visitorDataReportList',
        path: '/visitor-data-report-list',
        component: VisitorDataReportList,
      },
      {
        name: 'visitorDataReportDetail',
        path: '/visitor-data-report-detail',
        component: VisitorDataReportDetail,
      },
      {
        name: 'occupancyPreview',
        path: '/occupancyPreview',
        component: OccupancyPreview,
      },

      // Category
      {
        name: 'categories',
        path: '/categories',
        component: Category,
      },
      {
        name: 'categoryCreate',
        path: '/categories/create',
        component: CategoryCreate,
      },
      {
        name: 'categoryEdit',
        path: '/categories/:id',
        component: CategoryEdit,
      },

      // Carousal
      {
        name: 'carousal',
        path: '/carousals',
        component: Carousal,
      },
      {
        name: 'carousalCreate',
        path: '/carousals/create',
        component: CarousalCreate,
      },
      {
        name: 'carousalEdit',
        path: '/carousals/:id',
        component: CarousalEdit,
      },


    ]
  },

  {
    name: 'example',
    path: '/eg',
    component: Example
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
