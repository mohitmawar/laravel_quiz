<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\QuizQuestion;
use App\QuizResult;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class QuizController extends Controller
{

    /**
     * Display Quiz.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::where('status', '1')->get();
        return view('user.dashboard', compact('quiz'));
    }


    /**
     * Start Quiz
     *
     * @return \Illuminate\Http\Response
     */
    public function start(Quiz $quiz)
    {
        $question = null;
        $aUser = Auth::user();

        /* check is Quiz already attempted */
        $quiz_result = QuizResult::where([['quiz_id', $quiz->id], ['user_id', $aUser->id]])->first();
        if (!$quiz_result) {
            $quiz_result = QuizResult::create([
                'quiz_id' => $quiz->id,
                'user_id' => $aUser->id,
                'status' => 1
            ]);
        }

        /* last Question Attempt */
        if ($quiz_result->total_attempt) {
            $question = QuizQuestion::where([['quiz_id', $quiz->id], ['id', $quiz_result->total_attempt]])->first();
        } else {
            $question = QuizQuestion::where('quiz_id', $quiz->id)->orderBy('id', 'ASC')->first();
        }

        return view('user.start-quiz', compact('quiz_result', 'question'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function submit(QuizResult $quiz_result, Request $request)
    {
        $aUser    = Auth::user();
        $messages = [
            'quiz_id.required'  => 'Invalid Request',
            'question.required' => 'Invalid Request',
            'ans.0.required' => 'Select Valid answerer',
        ];
        $rules = [
            'quiz_id'       => 'required|Numeric',
            'question'      => 'required|Numeric',
            'ans.0'         => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        if (!empty($validator->errors()->messages())) {
            foreach ($validator->errors()->messages() as $key => $errorMessage) {
                return response()->json(['status' => false, 'message'   => $errorMessage[0],], Response::HTTP_BAD_REQUEST);
            }
        }

        $aData = $request->only('quiz_id', 'question', 'ans');

        try {
            /* make delay for 2 second */
            sleep(2);

            $current_question = QuizQuestion::where([['quiz_id', $quiz_result->quiz_id], ['id', $aData['question']]])->orderBy('id', 'ASC')->first();
            if (!$current_question) {
                return response()->json(['status' => false, 'message' => 'Error Invalid Request',], Response::HTTP_BAD_REQUEST);
            }

            /* check if user select correct answers */
            $status = true;
            if (count($aData['ans']) != count($current_question->answers)) {
                $status = false;
            }
            $wrong_ans = array_diff($aData['ans'], $current_question->answers);
            if (count($wrong_ans)) {
                $status = false;
            }

            /** Update user points */
            if ($status) {
                $quiz_result->total_right += 1;
            } else {
                $quiz_result->total_wrong += 1;
            }


            /* find next question  */
            $next_quest = ++$current_question->counter;
            $question = QuizQuestion::where([['quiz_id', $aData['quiz_id']], ['counter', $next_quest]])->first();

            /* request for quiz next question  */
            if ($question) {
                $quiz_result->total_attempt = $next_quest;
                /* render next question */
                $html = view('user.__start-quiz-question', compact('quiz_result', 'question'))->render();
            } else {

                /** 
                 * if new next question 
                 * Complete quiz after attempt all question 
                 * */
                $quiz_result->status = 0;

                /** 
                 * if user score more then 6 
                 * user clear the exam 
                 * */
                if ($quiz_result->total_right > 6) {
                    $quiz_result->is_pass = 1;
                }
                $html = view('user.quiz-result', compact('quiz_result'))->render();
            }
            $quiz_result->save();

            return response()->json(['status' => true, 'html' => $html,], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error Invalid Request',], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
