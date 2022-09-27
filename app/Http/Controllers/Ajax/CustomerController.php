<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Api\Crm;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Dealer;
use App\Models\Definition;
use App\Models\Manager;
use App\Models\Offer;
use App\Models\Opportunity;
use App\Models\Province;
use App\Models\Sample;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Customer::with([
            'province'
        ])->where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Customer::with([])->where('company_id', $request->company_id))->
        filterColumn('dealer_id', function ($customers, $keyword) {
            return $customers->whereIn('dealer_id', Dealer::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('user_id', function ($customers, $keyword) {
            return $customers->whereIn('user_id', User::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('company_id', function ($customers, $keyword) {
            return $customers->whereIn('company_id', Company::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('country_id', function ($customers, $keyword) {
            return $customers->whereIn('country_id', Country::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('province_id', function ($customers, $keyword) {
            return $customers->whereIn('province_id', Province::where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('class_id', function ($customers, $keyword) use ($request) {
            return $customers->whereIn('class_id', Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Sınıfları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('type_id', function ($customers, $keyword) use ($request) {
            return $customers->whereIn('type_id', Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Türleri')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('reference_id', function ($customers, $keyword) use ($request) {
            return $customers->whereIn('reference_id', Definition::where('company_id', $request->company_id)->where('name', 'Müşteri Referansları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        editColumn('id', function ($customer) {
            return '#' . $customer->id;
        })->
        editColumn('phone_number', function ($customer) {
            return '<a href="tel:' . '+' . @$customer->country->code . @General::clearPhoneNumber($customer->phone_number) . '">' . '+' . @$customer->country->code . ' ' . @$customer->phone_number . '</a>';
        })->
        editColumn('email', function ($customer) {
            return '<a href="mailto:' . $customer->email . '">' . $customer->email . '</a>';
        })->
        editColumn('dealer_id', function ($customer) {
            return $customer->dealer ? @$customer->dealer->name : '';
        })->
        editColumn('user_id', function ($customer) {
            return $customer->user ? @$customer->user->name : '';
        })->
        editColumn('company_id', function ($customer) {
            return $customer->company ? @$customer->company->name : '';
        })->
        editColumn('class_id', function ($customer) {
            return $customer->class ? @$customer->class->name : '';
        })->
        editColumn('type_id', function ($customer) {
            return $customer->type ? @$customer->type->name : '';
        })->
        editColumn('reference_id', function ($customer) {
            return $customer->reference ? @$customer->reference->name : '';
        })->
        editColumn('country_id', function ($customer) {
            return $customer->country ? @$customer->country->name : '';
        })->
        editColumn('province_id', function ($customer) {
            return $customer->province ? @$customer->province->name : '';
        })->
        editColumn('balance', function ($customer) {
            try {
                return number_format((new Crm)->getMusteriTicariProgramBakiye($customer->code), 2) . ' TL';
            } catch (\Exception $exception) {
                return '--';
            }
        })->
        rawColumns([
            'phone_number',
            'email'
        ])->
        make(true);
    }

    public function managersDatatable(Request $request)
    {
        return Datatables::of(Manager::with([])->where('customer_id', $request->customer_id))->
        editColumn('id', function ($manager) {
            return '#' . $manager->id;
        })->
        editColumn('birth_date', function ($manager) {
            return $manager->birth_date ? @date('d.m.Y', strtotime($manager->birth_date)) : '';
        })->
        editColumn('gender', function ($manager) {
            return $manager->gender == 1 ? 'Erkek' : 'Kadın';
        })->
        editColumn('department_id', function ($manager) {
            return $manager->department_id ? @$manager->department->name : '';
        })->
        editColumn('title_id', function ($manager) {
            return $manager->title_id ? @$manager->title->name : '';
        })->
        make(true);
    }

    public function offersDatatable(Request $request)
    {
        $offers = Offer::with([]);

        $opportunities = Opportunity::where('customer_id', $request->customer_id)->get();

        $offers->where(function ($offers) use ($request) {
            $offers->where('relation_type', 'App\\Models\\Customer')->where('relation_id', $request->customer_id);
        });

        if ($opportunities->count() > 0) {
            $offers->orWhere(function ($offers) use ($opportunities) {
                $offers->where('relation_type', 'App\\Models\\Opportunity')->whereIn('relation_id', $opportunities->pluck('id')->toArray());
            });
        }

        return Datatables::of($offers)->
        editColumn('id', function ($offer) {
            return '#' . $offer->id;
        })->
        editColumn('expiry_date', function ($offer) {
            return $offer->expiry_date ? @date('d.m.Y', strtotime($offer->expiry_date)) : '';
        })->
        editColumn('pay_type_id', function ($offer) {
            return $offer->pay_type_id ? @$offer->payType->name : '';
        })->
        editColumn('delivery_type_id', function ($offer) {
            return $offer->delivery_type_id ? @$offer->deliveryType->name : '';
        })->
        editColumn('status_id', function ($offer) {
            return $offer->status_id ? @$offer->status->name : '';
        })->
        editColumn('user_id', function ($offer) {
            return $offer->user_id ? @$offer->user->name : '';
        })->
        editColumn('company_id', function ($offer) {
            return $offer->company_id ? @$offer->company->name : '';
        })->
        make(true);
    }

    public function activitiesDatatable(Request $request)
    {
        $activities = Activity::with([]);

        $opportunities = Opportunity::where('customer_id', $request->customer_id)->get();

        $activities->where(function ($activities) use ($request) {
            $activities->where('relation_type', 'App\\Models\\Customer')->where('relation_id', $request->customer_id);
        });

        if ($opportunities->count() > 0) {
            $activities->orWhere(function ($activities) use ($opportunities) {
                $activities->where('relation_type', 'App\\Models\\Opportunity')->whereIn('relation_id', $opportunities->pluck('id')->toArray());
            });
        }

        return Datatables::of($activities)->
        editColumn('id', function ($activity) {
            return '#' . $activity->id;
        })->
        editColumn('company_id', function ($activity) {
            return $activity->company_id ? @$activity->company->name : '';
        })->
        editColumn('user_id', function ($activity) {
            return $activity->user_id ? @$activity->user->name : '';
        })->
        editColumn('start_date', function ($activity) {
            return $activity->start_date ? date('d.m.Y', strtotime($activity->start_date)) : '';
        })->
        editColumn('end_date', function ($activity) {
            return $activity->end_date ? date('d.m.Y', strtotime($activity->end_date)) : '';
        })->
        editColumn('priority_id', function ($activity) {
            return $activity->priority_id ? @$activity->priority->name : '';
        })->
        editColumn('meet_reason_id', function ($activity) {
            return $activity->meet_reason_id ? @$activity->meetReason->name : '';
        })->
        rawColumns(['customer_id', 'status_id'])->
        make(true);
    }

    public function samplesDatatable(Request $request)
    {
        $samples = Sample::with([]);

        $opportunities = Opportunity::where('customer_id', $request->customer_id)->get();

        $samples->where(function ($samples) use ($request) {
            $samples->where('relation_type', 'App\\Models\\Customer')->where('relation_id', $request->customer_id);
        });

        if ($opportunities->count() > 0) {
            $samples->orWhere(function ($samples) use ($opportunities) {
                $samples->where('relation_type', 'App\\Models\\Opportunity')->whereIn('relation_id', $opportunities->pluck('id')->toArray());
            });
        }

        return Datatables::of($samples)->
        editColumn('id', function ($sample) {
            return '#' . $sample->id;
        })->
        editColumn('date', function ($sample) {
            return $sample->date ? @date('d.m.Y', strtotime($sample->date)) : '';
        })->
        editColumn('cargo_company_id', function ($sample) {
            return $sample->cargo_company_id ? @$sample->cargoCompany->name : '';
        })->
        editColumn('status_id', function ($sample) {
            return $sample->status_id ? @$sample->status->name : '';
        })->
        editColumn('company_id', function ($sample) {
            return $sample->company_id ? @$sample->company->name : '';
        })->
        editColumn('user_id', function ($sample) {
            return $sample->user_id ? @$sample->user->name : '';
        })->
        make(true);
    }

    public function commentsDatatable(Request $request)
    {
        $comments = Comment::with([]);

        $opportunities = Opportunity::where('customer_id', $request->relation_id)->get();

        $comments->where(function ($comments) use ($request) {
            $comments->where('relation_type', 'App\\Models\\Customer')->where('relation_id', $request->relation_id);
        });

        if ($opportunities->count() > 0) {
            $comments->orWhere(function ($comments) use ($opportunities) {
                $comments->where('relation_type', 'App\\Models\\Opportunity')->whereIn('relation_id', $opportunities->pluck('id')->toArray());
            });
        }

        return Datatables::of($comments->get())->
        editColumn('id', function ($comment) {
            return '#' . $comment->id;
        })->
        editColumn('user_id', function ($comment) {
            return $comment->user_id ? @$comment->user->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Customer::with([
            'brands',
            'sectors'
        ])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $customerService = new CustomerService;
        $customerService->setCustomer($request->id ? Customer::find($request->id) : new Customer);
        $customerService->save($request);
    }

    public function drop(Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer->created_by == $request->auth_user_id) {
            $customer->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Müşteri Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $customer->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Müşteri Başarıyla Silindi'
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Başka Kullanıcıya Ait Verileri Silme Yetkiniz Bulunmuyor!'
                ], 200);
            }
        }
    }
}
