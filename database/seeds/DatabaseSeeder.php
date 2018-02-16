<?php
use App\Approval_status;
use App\Organization_type;
use App\Organization;
use App\Request_event_type;
use App\Request_item_purpose;
use App\Request_item_type;
use App\Requester_type;
use App\Role;
use App\RoleUser;
use App\Rule_type;
use App\Rule;
use App\Security_question;
use App\State;
use App\Subscription;
use App\User;
use App\EmailTemplate;
use App\EmailTemplateTypes;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// call our class and run our seeds
		$this->call('CqAppSeeder');
		$this->command->info('Cq app seeds finished.'); // show information in the command line after everything is run
	}

}

// our own seeder class
// usually this would be its own file
class CqAppSeeder extends Seeder {
	
	public function run() {
		// clear our database ------------------------------------------
//		DB::table('bears')->delete();

		// all states
		State::create(['state_code' => 'AK', 'state_name' => 'Alaska']);
        State::create(['state_code' => 'AL', 'state_name' => 'Alabama']);
        State::create(['state_code' => 'AR', 'state_name' => 'Arkansas']);
        State::create(['state_code' => 'AZ', 'state_name' => 'Arizona']);
        State::create(['state_code' => 'CA', 'state_name' => 'California']);
        State::create(['state_code' => 'CO', 'state_name' => 'Colorado']);
        State::create(['state_code' => 'CT', 'state_name' => 'Connecticut']);
        State::create(['state_code' => 'DC', 'state_name' => 'District of Columbia']);
        State::create(['state_code' => 'DE', 'state_name' => 'Delaware']);
        State::create(['state_code' => 'FL', 'state_name' => 'Florida']);
        State::create(['state_code' => 'GA', 'state_name' => 'Georgia']);
        State::create(['state_code' => 'GU', 'state_name' => 'Guam']);
        State::create(['state_code' => 'HI', 'state_name' => 'Hawaii']);
        State::create(['state_code' => 'IA', 'state_name' => 'Iowa']);
        State::create(['state_code' => 'ID', 'state_name' => 'Idaho']);
        State::create(['state_code' => 'IL', 'state_name' => 'Illinois']);
        State::create(['state_code' => 'IN', 'state_name' => 'Indiana']);
        State::create(['state_code' => 'KS', 'state_name' => 'Kansas']);
        State::create(['state_code' => 'KY', 'state_name' => 'Kentucky']);
        State::create(['state_code' => 'LA', 'state_name' => 'Louisiana']);
        State::create(['state_code' => 'MA', 'state_name' => 'Massachusetts']);
        State::create(['state_code' => 'MD', 'state_name' => 'Maryland']);
        State::create(['state_code' => 'ME', 'state_name' => 'Maine']);
        State::create(['state_code' => 'MI', 'state_name' => 'Michigan']);
        State::create(['state_code' => 'MN', 'state_name' => 'Minnesota']);
        State::create(['state_code' => 'MO', 'state_name' => 'Missouri']);
        State::create(['state_code' => 'MS', 'state_name' => 'Mississippi']);
        State::create(['state_code' => 'MT', 'state_name' => 'Montana']);
        State::create(['state_code' => 'NC', 'state_name' => 'North Carolina']);
        State::create(['state_code' => 'ND', 'state_name' => 'North Dakota']);
        $ne = State::create(['state_code' => 'NE', 'state_name' => 'Nebraska']);
        State::create(['state_code' => 'NH', 'state_name' => 'New Hampshire']);
        State::create(['state_code' => 'NJ', 'state_name' => 'New Jersey']);
        State::create(['state_code' => 'NM', 'state_name' => 'New Mexico']);
        State::create(['state_code' => 'NV', 'state_name' => 'Nevada']);
        State::create(['state_code' => 'NY', 'state_name' => 'New York']);
        State::create(['state_code' => 'OH', 'state_name' => 'Ohio']);
        State::create(['state_code' => 'OK', 'state_name' => 'Oklahoma']);
        State::create(['state_code' => 'OR', 'state_name' => 'Oregon']);
        State::create(['state_code' => 'PA', 'state_name' => 'Pennsylvania']);
        State::create(['state_code' => 'PR', 'state_name' => 'Puerto Rico']);
        State::create(['state_code' => 'RI', 'state_name' => 'Rhode Island']);
        State::create(['state_code' => 'SC', 'state_name' => 'South Carolina']);
        State::create(['state_code' => 'SD', 'state_name' => 'South Dakota']);
        State::create(['state_code' => 'TN', 'state_name' => 'Tennessee']);
        State::create(['state_code' => 'TX', 'state_name' => 'Texas']);
        State::create(['state_code' => 'UT', 'state_name' => 'Utah']);
        State::create(['state_code' => 'VA', 'state_name' => 'Virginia']);
        State::create(['state_code' => 'VI', 'state_name' => 'Virgin Islands']);
        State::create(['state_code' => 'VT', 'state_name' => 'Vermont']);
        State::create(['state_code' => 'WA', 'state_name' => 'Washington']);
        State::create(['state_code' => 'WI', 'state_name' => 'Wisconsin']);
        State::create(['state_code' => 'WV', 'state_name' => 'West Virginia']);
        State::create(['state_code' => 'WY', 'state_name' => 'Wyoming']);

		$this->command->info('states done ! ');

		// seed our user table -----------------------
		// we'll create five different user roles

		// Role - Root
		$ru = Role::create(array(
			'id' => '1',
			'name' => 'Root'
		));

		// Role - CQ Admin
		$cqa = Role::create(array(
			'id' => '2',
			'name' => 'CQ Admin'
		));

		// Role - CQ User
		$cqu = Role::create(array(
			'id' => '3', 
			'name' => 'CQ User'
		));
		// Role - Business Admin
		$bau = Role::create(array(
			'id' => '4',
			'name' => 'Business Admin'
		));
		// Role - Business User
		$buu = Role::create(array(
			'id' => '5',
		    'name' => 'Business User'
		));
		
		$this->command->info('User roles done ! ');

		// Org types Organization_typesTableSeeder 

		$orest = Organization_type::create(['id' => '1','type_name' => 'Restaurant', 'type_description' => 'Restaurant']);
        $ortl = Organization_type::create(['id' => '2', 'type_name' => 'Retail', 'type_description' => 'Retail']);
        $ohlth = Organization_type::create(['id' => '3', 'type_name' => 'Health/Beauty', 'type_description' => 'Health/Beauty']);;
        $oentr = Organization_type::create(['id' => '4','type_name' => 'Entertainment', 'type_description' => 'Entertainment']);
        $ohspt = Organization_type::create(['id' => '5','type_name' => 'Hospitality/Travel', 'type_description' => 'Hospitality/Travel']);
        $ob2bs = Organization_type::create(['id' => '6','type_name' => 'B2B Service', 'type_description' => 'B2B Service']);
        $ob2cs = Organization_type::create(['id' => '7','type_name' => 'B2C Service', 'type_description' => 'B2C Service']);
        $oothr = Organization_type::create(['id' => '8','type_name' => 'Others', 'type_description' => 'Anything other than the above options']);

				$this->command->info('Org type done ! ');

		// create orgs OrganizationsTableSeeder 
		$oroot = Organization::create(array(
		'id' => '1',
		'org_name' => 'CharityQ',
		'organization_type_id' => $oothr->id,
		'org_description' => 'Administrator and Owner of CharityQ',
		'street_address1' => '17117 Oak Drive',
		'street_address2' => 'Ste. A',
		'city' => 'Omaha',
		'zipcode' => '68130',
		'state' => $ne->state_code,
		'phone_number' => '(402) 715-5230',
		'trial_ends_at' => '2038-01-16'
		));

		// $buser = Organization::create(array(
		// 'org_name' => 'NFM',
		// 'organization_type_id' => $ortl->id,
		// 'org_description' => 'NFM',
		// 'street_address1' => 'NFM St',
		// 'street_address2' => 'Ste. A',
		// 'city' => 'Omaha',
		// 'zipcode' => '68130',
		// 'state' => $ne->state_code,
		// 'phone_number' => '(402) 715-5230',
		// 'trial_ends_at' => '2019-01-16'
		// ));
			$this->command->info('Orgs done ! ');

		// create user
		$rootuser = User::create(array(
			'id' => '1',
            'first_name' => 'root',
            'last_name' => 'admin',
            'user_name' => 'admin@cq.com',
            'email' => 'admin@cq.com',
            'password' => bcrypt('secret'),
            'organization_id' => $oroot->id,
            'street_address1' => '17117 Oak Drive',
            'street_address2' => 'Ste. A',
            'city' => 'Omaha',
            'zipcode' => '68130',
            'state' => $ne->state_code,
			'phone_number' => '(402) 715-5230'));
			// business user
			// $nfmusr = User::create(array(
			// 	'first_name' => 'Admin',
			// 	'last_name' => 'Nfm',
			// 	'user_name' => 'admin@nfm.com',
			// 	'email' => 'admin@nfm.com',
			// 	'password' => bcrypt('secret'),
			// 	'organization_id' => $buser->id,
			// 	'street_address1' => '17117 Oak Drive',
			// 	'street_address2' => 'Ste. A',
			// 	'city' => 'Omaha',
			// 	'zipcode' => '68130',
			// 	'state' => $ne->state_code,
			// 	'phone_number' => '(402) 715-5230'));
		// assign role 
		RoleUser::create(array(
			'id' => '1',
            'role_id' => $ru->id,
            'user_id' => $rootuser->id
		));
		// RoleUser::create(array(
        //     'role_id' => $bau->id,
        //     'user_id' => $nfmusr->id
        // ));
			$this->command->info('Root user done ! ');

		// create rule 
		$acpt = Rule_type::create(array( 'id' => '1' ,'type_name' => 'Auto-Reject', 'type_description' => 'Donation Requests that match the criteria of this rule will be automatically rejected by the system.', 'active' => true));
		$preacpt = Rule_type::create(array( 'id' => '2' ,'type_name' => 'Pre-Accept', 'type_description' => 'Donation Requests that match the criteria of this rule will be flagged as ready for acceptance by the user.', 'active' => true));
		
		// Rule
		 Rule::create(array('id' => '1', 'rule_type_id' => $preacpt->id, 'rule_owner_id' => $oroot->id, 'active' => true,
            'rule' => '{
                        "condition": "OR",
                        "rules": [
                            {
                            "id": "requester",
                            "field": "requester",
                            "type": "string",
                            "input": "text",
                            "operator": "contains",
                            "value": "tool"
                            },
                            {
                            "id": "needed_by_date",
                            "field": "needed_by_date",
                            "type": "date",
                            "input": "text",
                            "operator": "less_or_equal",
                            "value": "10/22/2017"
                            }
                        ],
                        "not": false,
                        "valid": true
                        }'
        ));
		Rule::create(array('id' => '2', 'rule_type_id' => $acpt->id, 'rule_owner_id' => $oroot->id, 'active' => true,
            'rule' => '{
            "condition": "AND",
            "rules": [
                {
                "id": "dollar_amount",
                "field": "dollar_amount",
                "type": "double",
                "input": "number",
                "operator": "less",
                "value": "300"
                },
                {
                "id": "requester_type",
                "field": "requester_type",
                "type": "integer",
                "input": "checkbox",
                "operator": "in",
                "value": [
                    "1",
                    "4",
                    "8"
                ]
                }
            ],
            "not": false,
            "valid": true
            }'
        ));
			$this->command->info('Rules done  ! ');
		// Request_event_typesTableSeeder
		Request_event_type::create(array(
			'id' => '1',
		'type_name' => 'Fundraiser/Gala', 
		'type_description' => 'Fundraiser'
		));
		Request_event_type::create(array(
			'id' => '2',
		'type_name' => 'Walk/Run/Ride Event',
		'type_description' => 'Walk/Run/Ride Event'
		));
		Request_event_type::create(array(
			'id' => '3',
		'type_name' => 'Charity Dinner', 
		'type_description' => 'Spaghetti, Pancake, etc. feed.'
		));
		Request_event_type::create(array(
			'id' => '4',
		'type_name' => 'Other', 
		'type_description' => 'Other Purposes'
		));

		// Request_item_typesTableSeeder 

		Request_item_type::create(array(
			'id' => '1',
		'item_name' => 'Cash/Check', 'item_description' => 'Monetary Donation'
		));
		Request_item_type::create(array(
			'id' => '2',
		'item_name' => 'Gift Card', 'item_description' => 'Store Credit'
		));
		Request_item_type::create(array(
			'id' => '3',
		'item_name' => 'Product/Service Donation', 'item_description' => 'Donation of Items or Services'
		));
		Request_item_type::create(array(
			'id' => '4',
		'item_name' => 'Sponsorship/Awareness', 'item_description' => 'Request for visibility'
		));
		Request_item_type::create(array(
			'id' => '5',
		'item_name' => 'Other (please explain)', 'item_description' => 'Other Types of Requests'
		));

		// Request_item_purposesTableSeeder 
		Request_item_purpose::create(array('id' => '1','purpose_name' => 'Raffle/Door Prize', 'purpose_description' => 'Raffle/Door Prize'));
		Request_item_purpose::create(array('id' => '2','purpose_name' => 'Live Auction', 'purpose_description' => 'Live Auction'));
		Request_item_purpose::create(array('id' => '3','purpose_name' => 'Silent Auction', 'purpose_description' => 'Silent Auction'));
		Request_item_purpose::create(array('id' => '4','purpose_name' => 'Online Auction', 'purpose_description' => 'Online Auction'));
		Request_item_purpose::create(array('id' => '5','purpose_name' => 'Supporting Services', 'purpose_description' => 'Participate in facilitating the event'));
		Request_item_purpose::create(array('id' => '6','purpose_name' => 'Awareness', 'purpose_description' => 'Increasing awareness for the event'));
		Request_item_purpose::create(array('id' => '7','purpose_name' => 'Funding Event', 'purpose_description' => 'Pay for Costs of Event'));
		Request_item_purpose::create(array('id' => '8','purpose_name' => 'Donation', 'purpose_description' => 'Contribute toward requesters Goal'));
		Request_item_purpose::create(array('id' => '9','purpose_name' => 'Other (please explain)', 'purpose_description' => 'Other Purposes'));

		// Request_item_type
		// Request_item_type::create(array('id' => '1','item_name' => 'Cash/Check', 'item_description' => 'Monetary Donation'));
		// Request_item_type::create(array('id' => '2','item_name' => 'Gift Card', 'item_description' => 'Store Credit'));
		// Request_item_type::create(array('id' => '3','item_name' => 'Product/Service Donation', 'item_description' => 'Donation of Items or Services'));
		// Request_item_type::create(array('id' => '4','item_name' => 'Sponsorship/Awareness', 'item_description' => 'Request for visibility'));
		// Request_item_type::create(array('id' => '5','item_name' => 'Other (please explain)', 'item_description' => 'Other Types of Requests'));

		// Requester_type
		Requester_type::create(array('type_name' => 'Animal Welfare', 'type_description' => 'This is an Animal Welfare'));
		Requester_type::create(array('type_name' => 'Arts, Culture & Humanities', 'type_description' => 'These are Arts, Culture & Humanities'));
		Requester_type::create(array('type_name' => 'Civil Rights, Social Action & Advocacy', 'type_description' => 'These are Civil Rights, Social Action & Advocacy'));
		Requester_type::create(array('type_name' => 'Community Improvement', 'type_description' => 'This is Community Improvement'));
		Requester_type::create(array('type_name' => 'Corporate Giving', 'type_description' => 'This is Corporate Giving'));
		Requester_type::create(array('type_name' => 'Education K-12', 'type_description' => 'This is an Education K-12'));
		Requester_type::create(array('type_name' => 'Environment', 'type_description' => 'This is an Environment'));
		Requester_type::create(array('type_name' => 'Faith/Religious', 'type_description' => 'This is a Faith/Religious'));
		Requester_type::create(array('type_name' => 'Food, Agriculture & Nutrition', 'type_description' => 'This is a Food, Agriculture & Nutrition'));
		Requester_type::create(array('type_name' => 'Health Care', 'type_description' => 'This is for Health Care'));
		Requester_type::create(array('type_name' => 'Human Services', 'type_description' => 'This is for Human Services'));
		Requester_type::create(array('type_name' => 'Youth Sports/Activities', 'type_description' => 'This is for Youth Sports/Activities'));
		Requester_type::create(array('type_name' => 'Others', 'type_description' => 'Other Types of Requesters'));

		// Security questions
		Security_question::create(array('question' => 'What was the name of your elementary / primary school?'));
		Security_question::create(array('question' => 'In what city or town does your nearest sibling live?'));
		Security_question::create(array('question' => 'What is your pet’s name?'));
		Security_question::create(array('question' => 'In what year was your father born?'));
		Security_question::create(array('question' => 'What was the house number and street name you lived in as a child?'));
		Security_question::create(array('question' => 'What were the last four digits of your childhood telephone number?'));
		Security_question::create(array('question' => 'What primary school did you attend?'));
		Security_question::create(array('question' => 'In what town or city was your first full time job?'));
		Security_question::create(array('question' => 'In what town or city did you meet your spouse/partner?'));
		Security_question::create(array('question' => 'What is the middle name of your oldest child?'));
		Security_question::create(array('question' => 'What are the last five digits of your driver\'s licence number?'));
		Security_question::create(array('question' => 'What is your grandmother\'s (on your mother\'s side) maiden name?'));
		Security_question::create(array('question' => 'What is your spouse or partner\'s mother\'s maiden name?'));
		Security_question::create(array('question' => 'In what town or city did your mother and father meet?'));
		Security_question::create(array('question' => 'What time of the day were you born? (hh:mm)'));
		Security_question::create(array('question' => 'What time of the day was your first child born? (hh:mm)'));
			$this->command->info('Other request info done ! ');
		// Approval_statusesTableSeeder 
		
		$subrw = Approval_status::create(array(
			'id' => '1' ,
			'status_name' => 'Submitted',
			'status_description' => 'Request submitted to business for review.'
		));
		
		$subrj = Approval_status::create(array(
			'id' => '2' ,
			'status_name' => 'Pending Rejection', 
			'status_description' => 'Request flagged as ready for business to reject.'
		));

		$suba = Approval_status::create(array(
			'id' => '3' , 
			'status_name' => 'Pending Approval', 
			 'status_description' => 'Request flagged as ready for business to approve.'
		));

		$subrrb = Approval_status::create(array(
			'id' => '4' ,
			'status_name' => 'Rejected',
			'status_description' => 'Request rejected by business.'
		));

		$subrab = Approval_status::create(array(
			'id' => '5' ,
			'status_name' => 'Approved', 
			'status_description' => 'Request accepted by business.'
		));

		$this->command->info('approval status done!');

		// Subscription
		Subscription::create(array(
			'id' => '1',
            'organization_id' => $oroot->id,
            'name' => 'main',
            'stripe_id' => 'sub_BjE4mUEBCjk86q',
            'stripe_plan' => 'annually999999',
            'quantity' => 999999,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ));


		// we'll create diff email EmailTemplateTypes

		$eadmin = EmailTemplateTypes::create(array(
			'id' => '1',
			'template_type' => 'Business Admin'
		));
		$euser = EmailTemplateTypes::create(array(
			'id' => '2',
			'template_type' => 'Business user'
		));
		$eaprv = EmailTemplateTypes::create(array(
			'id' => '3',
			'template_type' => 'Donation approved'
		));
		$erjct = EmailTemplateTypes::create(array(
			'id' => '4',
			'template_type' => 'Donation Rejected'
		));
		$efpwd = EmailTemplateTypes::create(array(
			'id' => '5',
			'template_type' => 'Forgot password'
		));

		// Email templates 
		EmailTemplate::create(array(
			'id' => '1',
			'template_type_id' => $eadmin->id, 
			'organization_id' => $oroot->id, 
			'email_subject' => 'Welcome to CharityQ!', 
			'email_message' => '<p>Thank you &nbsp;<strong>{Addressee}</strong>&nbsp;&nbsp;for registering your business on CharityQ. We look forward to helping your business save time and make it easy to support the charities you truly care about.</p>
		<p>You can log in any time to your account by using your email address as your user name.</p>
		<p>Thank you again for using CharityQ.</p>'
		));
		
		EmailTemplate::create(array(
			'id' => '2',
			'template_type_id' => $euser->id, 
			'organization_id' => $oroot->id, 
			'email_subject' => 'Welcome to CharityQ!', 
			'email_message' => '<p>Hello &nbsp;<strong>{Addressee}</strong>&nbsp;,</p>
		<p>You have been added as a new user to CharityQ for &nbsp;<strong>{My Business Name}.&nbsp;</strong>&nbsp;Please follow the link below to set up your new account.</p>
		<p>Thank you!</p>
		<p>&nbsp;- CharityQ Team</p>'
		));
		
		EmailTemplate::create(array(
			'id' => '3',
			'template_type_id' => $eaprv->id, 
			'organization_id' => $oroot->id, 
			'email_subject' => 'Decision about your donation request', 
			'email_message' => '<p>Dear &nbsp;<strong>{Addressee},&nbsp;</strong></p>
			<p>Thank you for entering a submitting a donation request through our website. We have reviewed your request and determined we are able to help you out with your request.</p>
			<p>&nbsp;</p>
			<p>Here are the instruction to pick up your donation:</p>
			<p>&nbsp;</p>
			<p>Thank you,</p>
			<p>&nbsp;<strong>{My Business Name}</strong>&nbsp;</p>'
			));
		
		EmailTemplate::create(array(
			'id' => '4',
			'template_type_id' => $erjct->id, 
			'organization_id' => $oroot->id, 
			'email_subject' => 'Your donation request has been declined', 
			'email_message' => '<p style="background: white;"><span style="font-size: 10.5pt; font-family: Verdana; color: black;">Dear &nbsp;<strong><span>{Addressee},&nbsp;</span></strong></span></p>
		<p style="background: white;"><span style="font-size: 10.5pt; font-family: Verdana; color: black;">Thank you for entering a request for donation on our website. Unfortunately, at this time we are not able to help out with your event.&nbsp;All of our Omaha locations have partnered with TAGG (Together a Greater Good) so that we can support as many local organizations as possible. In lieu of donating to specific raffles, auctions and galas, and sponsorships, we donate 5% of a guest&rsquo;s tab to an organization of their choosing. &nbsp;&nbsp;</span></p>
		<p style="font-family: Calibri, sans-serif;"><span style="font-size: 10.5pt; font-family: Verdana; color: black;">This is done through the TAGG mobile app, which is available for download on iPhones and Androids. Just search &ldquo;Together a Greater Good&rdquo; and you should find it!</span></p>'));
		
		EmailTemplate::create(array(
		'id' => '5',
		'template_type_id' => $efpwd->id, 'organization_id' => $oroot->id, 'email_subject' => 'Password Change Request', 'email_message' => '<p>Dear &nbsp;<strong>{Addressee},&nbsp;</strong>&nbsp;</p>
		<p>You have changed your password for CharityQ application. If it is not you that changed password please contact your admin as soon as possible.</p>
		<p>Sincerely,</p>
		<p>- CharityQ Team</p>'
		));
			$this->command->info('email stuff done ! ');
	}
}