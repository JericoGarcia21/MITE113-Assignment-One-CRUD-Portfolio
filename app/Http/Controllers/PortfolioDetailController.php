<?php

namespace App\Http\Controllers;

use App\Models\PortfolioDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioDetailController extends Controller
{
    public function index(): View
    {
        $portfolioDetails = PortfolioDetail::latest()->paginate(10);

        return view('portfolio-details.index', [
            'portfolioDetails' => $portfolioDetails,
        ]);
    }

    public function create(): View
    {
        return view('portfolio-details.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $portfolioDetail = PortfolioDetail::create($this->validatedData($request));

        return redirect()
            ->route('portfolio-details.show', $portfolioDetail)
            ->with('status', 'Portfolio detail created successfully.');
    }

    public function show(PortfolioDetail $portfolioDetail): View
    {
        return view('portfolio-details.show', [
            'portfolioDetail' => $portfolioDetail,
        ]);
    }

    public function edit(PortfolioDetail $portfolioDetail): View
    {
        return view('portfolio-details.edit', [
            'portfolioDetail' => $portfolioDetail,
        ]);
    }

    public function update(Request $request, PortfolioDetail $portfolioDetail): RedirectResponse
    {
        $portfolioDetail->update($this->validatedData($request));

        return redirect()
            ->route('portfolio-details.show', $portfolioDetail)
            ->with('status', 'Portfolio detail updated successfully.');
    }

    public function destroy(PortfolioDetail $portfolioDetail): RedirectResponse
    {
        $portfolioDetail->delete();

        return redirect()
            ->route('portfolio-details.index')
            ->with('status', 'Portfolio detail deleted successfully.');
    }

    /**
     * @return array<string, string>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'professional_title' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
        ]);
    }
}
